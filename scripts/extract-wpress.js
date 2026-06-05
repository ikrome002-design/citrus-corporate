#!/usr/bin/env node
'use strict';

const fs = require('fs');
const path = require('path');

const HEADER_SIZE = 4377;

function usage() {
  console.error('Usage: node scripts/extract-wpress.js <archive.wpress> <output-directory>');
  process.exit(2);
}

function cstr(buffer) {
  const zero = buffer.indexOf(0);
  return buffer.subarray(0, zero >= 0 ? zero : buffer.length).toString('utf8');
}

function sanitizeArchivePath(relativePath) {
  const normalized = relativePath.replace(/\\/g, '/').replace(/^\.\/?/, '');
  const parts = normalized.split('/').filter(Boolean);
  if (parts.some((part) => part === '..' || path.isAbsolute(part))) {
    throw new Error(`Unsafe archive path: ${relativePath}`);
  }
  return parts.join(path.sep);
}

function readAt(fd, position, length) {
  const buffer = Buffer.alloc(length);
  const bytesRead = fs.readSync(fd, buffer, 0, length, position);
  return buffer.subarray(0, bytesRead);
}

function copyRecord(fd, dataOffset, size, outputPath) {
  fs.mkdirSync(path.dirname(outputPath), { recursive: true });
  const out = fs.openSync(outputPath, 'w');
  const chunkSize = 1024 * 1024;
  const buffer = Buffer.alloc(chunkSize);
  let remaining = size;
  let position = dataOffset;

  try {
    while (remaining > 0) {
      const toRead = Math.min(chunkSize, remaining);
      const bytesRead = fs.readSync(fd, buffer, 0, toRead, position);
      if (!bytesRead) throw new Error(`Unexpected end of archive while writing ${outputPath}`);
      fs.writeSync(out, buffer, 0, bytesRead);
      remaining -= bytesRead;
      position += bytesRead;
    }
  } finally {
    fs.closeSync(out);
  }
}

const [archivePathArg, outputDirArg] = process.argv.slice(2).filter((arg) => !arg.startsWith('--'));
if (!archivePathArg || !outputDirArg) usage();

const archivePath = path.resolve(archivePathArg);
const outputDir = path.resolve(outputDirArg);
fs.mkdirSync(outputDir, { recursive: true });

const fd = fs.openSync(archivePath, 'r');
const stat = fs.fstatSync(fd);
let offset = 0;
let count = 0;

try {
  while (offset + HEADER_SIZE <= stat.size) {
    const header = readAt(fd, offset, HEADER_SIZE);
    const name = cstr(header.subarray(0, 255));
    if (!name) break;

    const size = Number(cstr(header.subarray(255, 269)) || 0);
    const relativePath = cstr(header.subarray(281, HEADER_SIZE));
    const archiveRelativePath = relativePath ? `${relativePath}/${name}` : name;
    const safeRelativePath = sanitizeArchivePath(archiveRelativePath);
    const outputPath = path.join(outputDir, safeRelativePath);

    if (!outputPath.startsWith(outputDir + path.sep) && outputPath !== outputDir) {
      throw new Error(`Refusing to write outside output directory: ${archiveRelativePath}`);
    }

    copyRecord(fd, offset + HEADER_SIZE, size, outputPath);
    offset += HEADER_SIZE + size;
    count += 1;
  }
} finally {
  fs.closeSync(fd);
}

console.log(`Extracted ${count} records to ${outputDir}`);
