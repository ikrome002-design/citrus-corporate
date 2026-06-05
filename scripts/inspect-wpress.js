#!/usr/bin/env node
'use strict';

const fs = require('fs');
const path = require('path');

const HEADER_SIZE = 4377;
const MAX_SCAN_TEXT_BYTES = 2 * 1024 * 1024;

function usage() {
  console.error('Usage: node scripts/inspect-wpress.js <archive.wpress> [--masked] [--json]');
  process.exit(2);
}

function cstr(buffer) {
  const zero = buffer.indexOf(0);
  return buffer.subarray(0, zero >= 0 ? zero : buffer.length).toString('utf8');
}

function readAt(fd, position, length) {
  const buffer = Buffer.alloc(length);
  const bytesRead = fs.readSync(fd, buffer, 0, length, position);
  return buffer.subarray(0, bytesRead);
}

function mask(value) {
  const stringValue = String(value || '');
  if (!stringValue) return '';
  if (stringValue.length <= 8) return '[masked]';
  return `${stringValue.slice(0, 4)}...${stringValue.slice(-4)}`;
}

function headerValue(text, key) {
  const expression = new RegExp(`^\\s*\\*?\\s*${key.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')}\\s*:\\s*(.+)$`, 'mi');
  const match = text.match(expression);
  return match ? match[1].trim() : null;
}

function parseArchive(filePath) {
  const fd = fs.openSync(filePath, 'r');
  const stat = fs.fstatSync(fd);
  const records = [];
  const byFullPath = new Map();
  let offset = 0;

  try {
    while (offset + HEADER_SIZE <= stat.size) {
      const header = readAt(fd, offset, HEADER_SIZE);
      const name = cstr(header.subarray(0, 255));
      if (!name) break;

      const size = Number(cstr(header.subarray(255, 269)) || 0);
      const mtime = Number(cstr(header.subarray(269, 281)) || 0);
      const relativePath = cstr(header.subarray(281, HEADER_SIZE));
      const fullPath = relativePath ? `${relativePath}/${name}` : name;
      const record = { name, size, mtime, relativePath, fullPath, offset };

      records.push(record);
      byFullPath.set(fullPath, record);
      offset += HEADER_SIZE + size;
    }

    return { fd, stat, records, byFullPath, parsedBytes: offset };
  } catch (error) {
    fs.closeSync(fd);
    throw error;
  }
}

function readRecordText(fd, record, maxBytes = Infinity) {
  const length = Math.min(record.size, maxBytes);
  return readAt(fd, record.offset + HEADER_SIZE, length).toString('utf8');
}

function inspect(filePath) {
  const parsed = parseArchive(filePath);
  const { fd, stat, records, byFullPath, parsedBytes } = parsed;

  try {
    const packageRecord = byFullPath.get('./package.json') || byFullPath.get('package.json');
    let manifest = {};
    if (packageRecord) {
      manifest = JSON.parse(readRecordText(fd, packageRecord));
    }

    const topLevel = new Map();
    const pluginDirs = new Set();
    const themeDirs = new Set();
    const themeHeaders = [];
    const pluginHeaders = [];
    const sensitiveEntries = [];

    for (const record of records) {
      const top = record.relativePath.split(/[\\/]/)[0] || '(root)';
      topLevel.set(top, (topLevel.get(top) || 0) + 1);

      const parts = record.fullPath.split(/[\\/]/);
      if (parts[0] === 'plugins' && parts[1] && parts[1] !== 'index.php') pluginDirs.add(parts[1]);
      if (parts[0] === 'themes' && parts[1] && parts[1] !== 'index.php') themeDirs.add(parts[1]);

      if (/^themes\/[^/]+\/style\.css$/i.test(record.fullPath)) {
        const text = readRecordText(fd, record, 4096);
        themeHeaders.push({
          file: record.fullPath,
          name: headerValue(text, 'Theme Name'),
          version: headerValue(text, 'Version'),
          testedUpTo: headerValue(text, 'Tested up to'),
          requiresPHP: headerValue(text, 'Requires PHP'),
          requiresWordPress: headerValue(text, 'Requires at least'),
        });
      }

      if (/^plugins\/[^/]+\/[^/]+\.php$/i.test(record.fullPath)) {
        const text = readRecordText(fd, record, 4096);
        if (/Plugin Name\s*:/i.test(text)) {
          pluginHeaders.push({
            file: record.fullPath,
            name: headerValue(text, 'Plugin Name'),
            version: headerValue(text, 'Version'),
            testedUpTo: headerValue(text, 'Tested up to') || headerValue(text, 'Elementor tested up to'),
          });
        }
      }

      if (/database\.sql$|\.env$|wp-config|wflogs|logs\/|backup|updraft|ai1wm|debug\.log|purchase|license|secret|token|password|smtp|stripe|paypal/i.test(record.fullPath)) {
        sensitiveEntries.push({ file: record.fullPath, size: record.size });
      }
    }

    const databaseRecord = byFullPath.get('./database.sql') || byFullPath.get('database.sql');
    const database = { present: Boolean(databaseRecord) };
    if (databaseRecord) {
      const text = readRecordText(fd, databaseRecord, MAX_SCAN_TEXT_BYTES);
      database.size = databaseRecord.size;
      database.hasPasswordHashMarkers = /user_pass|\$P\$|\$wp/i.test(text);
      database.hasEmailLikeValues = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i.test(text);
      database.smtpMentions = (text.match(/smtp|mailgun|sendgrid/gi) || []).length;
      database.paymentMentions = (text.match(/stripe|paypal/gi) || []).length;
    }

    const codeFindings = [];
    const priorityFindings = [];
    const genericFindings = [];
    for (const record of records) {
      if (!/\.(php|js|json|txt|md|html|log)$/i.test(record.fullPath)) continue;
      if (record.size > MAX_SCAN_TEXT_BYTES) continue;

      const text = readRecordText(fd, record, MAX_SCAN_TEXT_BYTES);
      const priorityPatterns = [
        { type: 'purchase_code', re: /update_option\(\s*['"][^'"]*purchase_code[^'"]*['"]\s*,\s*['"]([^'"]{8,})/gi },
        { type: 'license_key', re: /update_option\(\s*['"][^'"]*license_key[^'"]*['"]\s*,\s*['"]([^'"]{8,})/gi },
        { type: 'purchase_code', re: /purchase_code['"]?\s*,\s*['"]([^'"]{8,})/gi },
        { type: 'license_key', re: /license_key['"]?\s*,\s*['"]([^'"]{8,})/gi },
      ];
      const genericPatterns = [
        { type: 'secret_keyword', re: /(api[_-]?key|client_secret|access_token|secret|token|password)\s*[=:,]\s*['"]?([^'"\s,;)]+)/gi },
      ];

      for (const pattern of priorityPatterns) {
        let match;
        while ((match = pattern.re.exec(text)) && priorityFindings.length < 25) {
          priorityFindings.push({
            file: record.fullPath,
            type: pattern.type,
            evidence: mask(match[1]),
          });
        }
      }

      for (const pattern of genericPatterns) {
        let match;
        while ((match = pattern.re.exec(text)) && genericFindings.length < 25) {
          genericFindings.push({
            file: record.fullPath,
            type: pattern.type,
            evidence: mask(match[2]),
          });
        }
      }
    }

    codeFindings.push(...priorityFindings, ...genericFindings);

    return {
      archive: {
        path: filePath,
        bytes: stat.size,
        records: records.length,
        parsedBytes,
        trailingBytes: stat.size - parsedBytes,
      },
      manifest: {
        siteUrl: manifest.SiteURL || null,
        homeUrl: manifest.HomeURL || null,
        allInOneWpMigrationVersion: manifest.Plugin && manifest.Plugin.Version,
        wordpressVersion: manifest.WordPress && manifest.WordPress.Version,
        phpVersion: manifest.PHP && manifest.PHP.Version,
        phpSystem: manifest.PHP && manifest.PHP.System,
        databaseVersion: manifest.Database && manifest.Database.Version,
        databaseCharset: manifest.Database && manifest.Database.Charset,
        databasePrefix: manifest.Database && manifest.Database.Prefix,
        template: manifest.Template || null,
        stylesheet: manifest.Stylesheet || null,
        activePlugins: manifest.Plugins || [],
      },
      topLevel: Object.fromEntries([...topLevel.entries()].sort()),
      pluginDirs: [...pluginDirs].sort(),
      themeDirs: [...themeDirs].sort(),
      themeHeaders,
      pluginHeaders: pluginHeaders.sort((a, b) => String(a.file).localeCompare(String(b.file))),
      database,
      sensitiveEntries: sensitiveEntries.slice(0, 100),
      codeFindings: codeFindings.slice(0, 25),
    };
  } finally {
    fs.closeSync(fd);
  }
}

const args = process.argv.slice(2);
if (!args.length) usage();

const archivePath = args.find((arg) => !arg.startsWith('--'));
if (!archivePath) usage();

const json = args.includes('--json');
const result = inspect(path.resolve(archivePath));

if (json) {
  console.log(JSON.stringify(result, null, 2));
} else {
  console.log(`# WPress Inspection: ${result.archive.path}`);
  console.log(`Archive bytes: ${result.archive.bytes}`);
  console.log(`Records: ${result.archive.records}`);
  console.log(`Trailing bytes: ${result.archive.trailingBytes}`);
  console.log(`WordPress: ${result.manifest.wordpressVersion || 'unknown'}`);
  console.log(`PHP: ${result.manifest.phpVersion || 'unknown'} (${result.manifest.phpSystem || 'unknown system'})`);
  console.log(`Database: ${result.manifest.databaseVersion || 'unknown'}`);
  console.log(`Active theme: ${result.manifest.stylesheet || 'unknown'}`);
  console.log(`Database dump present: ${result.database.present ? 'yes' : 'no'}`);
  console.log(`Password/email-like database material: ${result.database.hasPasswordHashMarkers || result.database.hasEmailLikeValues ? 'yes' : 'not detected in scan window'}`);
  console.log(`Plugin directories: ${result.pluginDirs.join(', ') || 'none detected'}`);
  console.log(`Theme directories: ${result.themeDirs.join(', ') || 'none detected'}`);
  console.log('Theme headers:');
  for (const theme of result.themeHeaders) {
    console.log(`- ${theme.name || theme.file} ${theme.version || ''} tested up to ${theme.testedUpTo || 'unknown'}`);
  }
  console.log('Sensitive entry indicators:');
  for (const entry of result.sensitiveEntries.slice(0, 25)) {
    console.log(`- ${entry.file} (${entry.size} bytes)`);
  }
  if (result.sensitiveEntries.length > 25) {
    console.log(`- ... ${result.sensitiveEntries.length - 25} more masked/sensitive indicators`);
  }
  console.log('Masked code findings:');
  for (const finding of result.codeFindings.slice(0, 10)) {
    console.log(`- ${finding.file}: ${finding.type} ${finding.evidence}`);
  }
}
