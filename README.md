# Citrus Labs WordPress Export Wrapper

## Overview

This repository is a private GitHub wrapper for a legacy Citrus Labs WordPress backup exported with All-in-One WP Migration. It is not a full WordPress source-code repository, Bedrock project, custom plugin, custom theme repository, or frontend application.

The main purpose of the repo is to preserve the original `.wpress` export with Git LFS, document its security risks, and provide repeatable inspection and local restore helpers for future maintainers. It is intended for developers or site maintainers who need to audit, restore, verify, or migrate the old WordPress site safely.

The previous README was too compact for handoff because it did not fully explain the wrapper repo shape, local restore flow, absent package/test tooling, or the difference between a private LFS backup repo and a public-safe source repo.

## Key Features

- Tracks the original All-in-One WP Migration export: `WordPress File/citruslabs.co.ke-20230502-111130-phqg9h.wpress`.
- Uses Git LFS for `*.wpress` files through `.gitattributes`.
- Provides a masked, read-only archive inspector at `scripts/inspect-wpress.js`.
- Provides a local `.wpress` extractor at `scripts/extract-wpress.js`.
- Provides a PowerShell DDEV restore/check flow at `scripts/ddev-restore-check.ps1`.
- Includes DDEV configuration for a WordPress restore environment using PHP 8.3, Apache FPM, and MariaDB 10.6.
- Documents archive security risks in `ARCHIVE_SECURITY.md`.
- Ignores local restore output, extracted WordPress files, database dumps, cache/log files, uploads, environment files, and generated dependency folders.

## Project Type

Other detected type: legacy WordPress export wrapper.

This repository stores and documents a WordPress backup export. The application code, database dump, media uploads, plugins, themes, mu-plugins, and logs are inside the `.wpress` archive rather than checked out as normal WordPress source folders.

Detected from the archive manifest and inspection script:

- WordPress version in export: 6.2
- All-in-One WP Migration version in export: 7.73
- PHP version in export: 8.2.5 on Linux
- Database version in export: `5.7.23-23`
- Active theme stylesheet/template: `dt-the7`
- Active theme header name: `CITRUS LABS`
- Active theme version: 11.4.1.1
- Archive records parsed: 12,056
- Archive includes: `database.sql`, `plugins/`, `themes/`, `uploads/`, `mu-plugins/`, `logs/`, and `wflogs/`

## Tech Stack

### Backend

- WordPress, contained inside the `.wpress` export data rather than checked out as `wp-admin`, `wp-includes`, and root WordPress files.
- PHP runtime evidence:
  - Export manifest: PHP 8.2.5
  - DDEV restore target: PHP 8.3

### Frontend

- WordPress theme/frontend assets are inside the `.wpress` export.
- Detected theme directories inside the archive:
  - `dt-the7`
  - `twentytwentyone`
  - `twentytwentytwo`
  - `twentytwentythree`
- Detected active theme: `dt-the7`
- No standalone frontend package manager, `package.json`, Vite, Webpack, React, Vue, or build script exists in this wrapper repo.

### Database

- The `.wpress` archive contains `database.sql`.
- Export manifest reports database version `5.7.23-23`, charset `utf8`, and table prefix `7nA_`.
- Local verification target in `.ddev/config.yaml` is MariaDB 10.6.
- The archive inspector detects password-hash markers and email-like material in the database scan window, so the archive must be treated as sensitive.

### Tooling

- Git
- Git LFS, configured for `*.wpress`
- Node.js for local helper scripts
- PowerShell for the DDEV restore/check script
- DDEV and Docker for optional local WordPress restore verification
- WP-CLI through DDEV during restore checks

No Composer package file, npm package file, lock file, test configuration, or CI workflow is present in this repo.

## Project Structure

```txt
project-root/
├── .ddev/
│   └── config.yaml                 # DDEV WordPress restore environment config
├── scripts/
│   ├── inspect-wpress.js           # Read-only masked .wpress inspector
│   ├── extract-wpress.js           # Local .wpress extractor for restore workflows
│   └── ddev-restore-check.ps1      # DDEV restore and verification flow
├── User Manual/
│   ├── User Manual.docx            # Original user manual document
│   └── User Manual.pdf             # Original user manual PDF
├── WordPress File/
│   └── citruslabs.co.ke-20230502-111130-phqg9h.wpress
│                                      # Sensitive WordPress export tracked with Git LFS
├── .gitattributes                  # Git LFS rule for *.wpress
├── .gitignore                      # Ignore rules for secrets and local restore output
├── ARCHIVE_SECURITY.md             # Security warnings and rotation guidance
└── README.md                       # Project documentation
```

Generated local restore paths such as `wp/`, `.restore/`, database dumps, uploads, caches, logs, `vendor/`, and `node_modules/` are intentionally ignored.

## WordPress Export Contents

The archive inspector reports these active plugins from the export manifest:

- `disable-admin-notices/disable-admin-notices.php`
- `elementor/elementor.php`
- `elementskit-lite/elementskit-lite.php`
- `elfsight-social-icons-cc/elfsight-social-icons-cc.php`
- `elfsight-testimonials-slider-cc/elfsight-testimonials-slider-cc.php`
- `litespeed-cache/litespeed-cache.php`
- `pro-elements/pro-elements.php`
- `really-simple-ssl/rlrsssl-really-simple-ssl.php`
- `revslider/revslider.php`
- `robin-image-optimizer/robin-image-optimizer.php`
- `the-plus-addons-for-elementor-page-builder/theplus_elementor_addon.php`
- `theplus_elementor_addon/theplus_elementor_addon.php`
- `wordfence/wordfence.php`

Detected mu-plugins:

- `endurance-page-cache.php`
- `sso.php`

Do not update or redistribute commercial/premium code from the archive unless license and update-source rights are confirmed.

## Authentication and Integrations

Authentication is WordPress authentication from the restored database/export. This wrapper repo does not define a separate authentication system, API server, controller layer, or user model.

The masked archive scan detects database password/email-like material, SMTP mentions, payment-related mentions, and plugin purchase/license indicators. The README intentionally does not include real credentials, hashes, tokens, payment keys, SMTP settings, private URLs, or license values.

## Local URLs

The DDEV restore helper uses this local URL by default:

```txt
https://citrus-labs-export.ddev.site
```

The URL can be overridden through the `-LocalUrl` parameter on `scripts/ddev-restore-check.ps1`.

## Requirements

Required for repository management:

- Git
- Git LFS

Required for helper scripts:

- Node.js 18 or newer
- PowerShell, for `scripts/ddev-restore-check.ps1`

Required for local WordPress restore verification:

- Docker
- DDEV

Host WP-CLI is not required by this repo; the restore script runs `wp` through `ddev wp`.

## Setup

Clone the private repository and install Git LFS objects:

```powershell
git lfs install --local
git lfs pull
```

Check that `.wpress` files are tracked by LFS:

```powershell
git lfs track
git lfs ls-files
```

Expected tracked pattern:

```txt
*.wpress
```

## Inspect the Export

Run the masked archive inspection script:

```powershell
node scripts/inspect-wpress.js "WordPress File/citruslabs.co.ke-20230502-111130-phqg9h.wpress" --masked
```

JSON output is also supported:

```powershell
node scripts/inspect-wpress.js "WordPress File/citruslabs.co.ke-20230502-111130-phqg9h.wpress" --json
```

The inspector reads `.wpress` record headers, parses the export manifest, lists detected plugins/themes, detects the database dump, and masks sensitive evidence. It must not be used to print full database rows, password hashes, salts, tokens, purchase codes, or credentials.

## Extract the Export Locally

The low-level extractor writes archive records to an output directory:

```powershell
node scripts/extract-wpress.js "WordPress File/citruslabs.co.ke-20230502-111130-phqg9h.wpress" ".restore\wpress"
```

The `.restore/` directory is ignored by Git. Extracted database files, uploads, logs, cache files, plugins, themes, and WordPress runtime files should remain local verification artifacts unless a future migration plan explicitly changes the repository shape.

## Local WordPress Restore with DDEV

After installing DDEV and Docker, start the DDEV environment:

```powershell
ddev start
```

Run the restore/check script:

```powershell
powershell -ExecutionPolicy Bypass -File scripts/ddev-restore-check.ps1
```

The script performs these actions based on the current file contents:

- Requires `node` and `ddev` on PATH.
- Runs the masked `.wpress` inspector.
- Extracts the archive into `.restore/wpress`.
- Downloads WordPress 6.2 into the ignored `wp/` docroot.
- Creates a local `wp-config.php` for DDEV.
- Copies exported `plugins`, `themes`, `mu-plugins`, `uploads`, `wflogs`, and `logs` into `wp/wp-content`.
- Imports `database.sql` if it exists after extraction.
- Runs a search-replace from the exported site URL to the local DDEV URL.
- Runs baseline WP-CLI checks.
- Creates a DDEV snapshot named `before-wp-7-trial`.
- Attempts a WordPress 7.0 core update and database update for compatibility testing.

## Environment Variables

No `.env.example` exists and no wrapper-level environment variables are required by the checked-in scripts.

The DDEV config defines one local web environment value:

```txt
WP_ENVIRONMENT_TYPE=local
```

Do not commit real `.env` files or production `wp-config.php` values. `.env`, `.env.*`, `wp-config.php`, and `wp-config-local.php` are ignored.

## Database Setup

There are no checked-in database migrations or seeders.

For local verification, the database setup is handled by `scripts/ddev-restore-check.ps1`:

- Extract `database.sql` from the `.wpress` archive.
- Import it with `ddev import-db`.
- Run WordPress URL replacement with `ddev wp search-replace`.
- Run `ddev wp db check`.

The database dump contains sensitive material and must remain out of normal Git tracking.

## Build Process

There is no application build process in this wrapper repo.

No `package.json`, `composer.json`, frontend build config, or Composer project file exists at the repository root. No Node or Composer install/build command is available unless a future change adds the relevant project files.

## Test and Validation Process

There is no automated test suite in this repo.

Available validation commands are:

```powershell
node --check scripts/inspect-wpress.js
node --check scripts/extract-wpress.js
node scripts/inspect-wpress.js "WordPress File/citruslabs.co.ke-20230502-111130-phqg9h.wpress" --masked
git status --short
git lfs version
git lfs track
git lfs ls-files
```

After DDEV restore succeeds, run:

```powershell
ddev wp core version --path=wp
ddev wp core verify-checksums --path=wp
ddev wp db check --path=wp
ddev wp plugin list --path=wp
ddev wp theme list --path=wp
ddev wp option get siteurl --path=wp
ddev wp option get home --path=wp
```

These commands validate the restored WordPress environment, not the wrapper repo itself.

## GitHub Safety Requirements

This repository must remain private while it tracks the current `.wpress` file.

Confirmed archive risks are documented in `ARCHIVE_SECURITY.md`:

- The export contains `database.sql`.
- The database scan detects password-hash markers and email-like material.
- The archive includes uploads, logs, Wordfence logs, plugins, themes, and mu-plugins.
- The masked scan detects plugin purchase/license indicators.
- Commercial or premium plugin/theme code is present in the archive.

Before pushing:

```powershell
git status --short
git lfs ls-files
git diff --cached --check
```

Confirm:

- The `.wpress` file appears in `git lfs ls-files`.
- No extracted database dump is staged separately.
- No `.env` or real `wp-config.php` is staged.
- No restored `wp/`, `.restore/`, uploads, logs, cache, or backup output is staged.

After any real restore, rotate WordPress passwords, salts, SMTP credentials, payment/API/OAuth/webhook/cloud credentials, and plugin license or purchase keys found in the restored files or database.

## Deployment

No production deployment configuration is present in this repository.

The DDEV configuration is for local restore and verification only. Do not treat this repo as a deployable WordPress application without a separate migration/deployment plan.

## Recommended Commit Message

```txt
Document private WordPress export wrapper
```
