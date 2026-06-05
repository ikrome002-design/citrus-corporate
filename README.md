# Citrus Labs WordPress Site

## Overview

This repository contains a legacy full WordPress installation for the Citrus Labs website. The WordPress document root is `citrus/`, and the site content in the included database export points to a public-facing marketing/landing website with page-builder sections, countdown widgets, newsletter/form widgets, social icons, sliders, and a coming-soon/maintenance plugin.

The project is for maintainers who need to run, preserve, audit, or safely publish the existing WordPress site source. It is not a modern framework app with root-level package scripts, Docker files, CI workflows, controllers, API routes, or test suites.

The previous README was a short GitHub-readiness note. It needed expansion because it did not fully describe the detected project structure, WordPress stack, local setup requirements, available commands, environment placeholders, database expectations, or maintainer safety rules.

## Key Features

- Full WordPress core tree under `citrus/`, currently reporting WordPress `6.0`.
- Classic active theme: `citrus` / ConnectedWing `9.1.0`.
- Static front page configured in the SQL dump with `show_on_front = page` and `page_on_front = 2`.
- Page-builder content using WPBakery/The7 shortcodes in the database export.
- Countdown, coming-soon/maintenance, form, social icon, slider, and page-builder plugins present.
- Theme templates for pages, posts, search, archives, 404s, blog layouts, portfolio layouts, media layouts, team pages, testimonials, microsites, headers, footers, and sidebars.
- WooCommerce template overrides are present in the active theme, but the WooCommerce plugin directory was not detected in `citrus/wp-content/plugins/`.
- Must-use plugins for Endurance page cache and SSO are present in `citrus/wp-content/mu-plugins/`.
- GitHub safety rules ignore local secrets, uploads, SQL dumps, logs, caches, backups, and packaged export artifacts.

## Project Type

Full WordPress website / legacy PHP CMS project.

This is not a Bedrock project, not a Laravel/Django/Node app, not a static site, and not a standalone frontend app. No root `composer.json`, root `package.json`, Dockerfile, `docker-compose.yml`, `.github/` workflows, or root test configuration files were detected.

## Tech Stack

### Backend

- WordPress core `6.0`
- PHP WordPress theme and plugin code
- Active classic theme: ConnectedWing `9.1.0`
- WordPress authentication via core user/session system
- Must-use SSO plugin: `sso.php` version `0.4`
- Must-use page cache plugin: Endurance Page Cache `2.2`

### Frontend

- WordPress PHP templates
- The7/ConnectedWing theme assets under `citrus/wp-content/themes/citrus/`
- WPBakery/The7 page-builder shortcodes stored in the database
- Slider Revolution plugin assets
- Theme template parts for headers, footers, blog layouts, portfolio layouts, page title layouts, and mobile headers

### Database

- MySQL/MariaDB expected by WordPress.
- WordPress core file requirements report minimum MySQL `5.0`, but the maintenance target for this repository is MySQL `8.0+` or MariaDB `10.6+`.
- A local SQL export exists as `citrusl1_WPHOK.sql`, but it is ignored by Git because database dumps can contain private URLs, user records, password hashes, and configuration values.

### Tooling

- Local PHP CLI was verified.
- Composer CLI was verified, but there is no root Composer project.
- Node and npm were verified, but there is no root Node project and no root npm scripts.
- WP-CLI was not available on PATH during inspection.
- MySQL CLI was not available on PATH during inspection.
- Package/config files exist only inside bundled WordPress dependencies or bundled themes/plugins.

## Project Structure

```txt
project-root/
|-- .env.example                 # Safe placeholder environment inventory
|-- .gitignore                   # GitHub safety ignores for secrets/artifacts
|-- README.md                    # Project documentation
|-- citrusl1_WPHOK.sql           # Local database export, ignored by Git
`-- citrus/
    |-- index.php                # WordPress front controller
    |-- wp-admin/                # WordPress admin core files
    |-- wp-includes/             # WordPress core library files
    |-- wp-content/
    |   |-- themes/
    |   |   |-- citrus/          # Active ConnectedWing theme
    |   |   |-- sinatra/         # Installed theme
    |   |   `-- twenty*/         # Installed default WordPress themes
    |   |-- plugins/             # Installed standard plugins
    |   |-- mu-plugins/          # Must-use host/cache/SSO plugins
    |   |-- uploads/             # Local media uploads, ignored by Git
    |   `-- upgrade/             # WordPress upgrade working directory, ignored by Git
    |-- wp-config-sample.php     # Safe WordPress sample config
    |-- wp-config.php            # Local runtime config, ignored by Git
    |-- wp-cli.yml               # WP-CLI hint for Apache mod_rewrite
    `-- .htaccess                # cPanel-generated PHP handler note
```

Important active-theme areas:

```txt
citrus/wp-content/themes/citrus/
|-- functions.php                # Loads inc/init.php
|-- inc/                         # Theme initialization, admin, widgets, shortcodes, helpers
|-- template-parts/              # Header, footer, blog, page-title, microsite, layout parts
|-- woocommerce/                 # WooCommerce template overrides
|-- css/, js/, fonts/, images/   # Theme assets
`-- template-*.php               # Blog, portfolio, media, team, testimonial templates
```

## Installed Themes

| Directory | Theme | Version |
| --- | --- | --- |
| `citrus` | ConnectedWing | `9.1.0` |
| `sinatra` | Sinatra | `1.1.5` |
| `twentynineteen` | Twenty Nineteen | `1.7` |
| `twentyseventeen` | Twenty Seventeen | `2.4` |
| `twentytwenty` | Twenty Twenty | `1.5` |
| `twentytwentyone` | Twenty Twenty-One | `1.0` |
| `twentytwentytwo` | Twenty Twenty-Two | `1.2` |

The SQL dump identifies `citrus` as both `template` and `stylesheet`, with current theme `ConnectedWing`.

## Installed Plugins

| Directory | Plugin | Version | Active in SQL dump |
| --- | --- | --- | --- |
| `cmp-coming-soon-maintenance` | CMP - Coming Soon & Maintenance Plugin | `3.8.9` | Yes |
| `countdown_with_background` | CountDown With Image or Video Background | `1.3.6` | No |
| `elfsight-countdown-timer-cc` | Elfsight Countdown Timer CC | `1.3.0` | Yes |
| `elfsight-form-builder-cc` | Elfsight Form Builder CC | `1.5.1` | Yes |
| `elfsight-social-media-icons-cc` | Elfsight Social Media Icons CC | `1.3.0` | Yes |
| `js_composer` | The7 WPBakery Page Builder | `6.4.1` | Yes |
| `revslider` | The7 Slider Revolution | `6.2.23` | Yes |
| `Ultimate_VC_Addons` | The7 Ultimate Addons for WPBakery Page Builder | `3.19.7` | Yes |
| `unlimited-addons-for-wpbakery-page-builder` | Unlimited Addons for WPBakery Page Builder | `1.0.41` | Yes |

Must-use plugins:

| File | Plugin | Version |
| --- | --- | --- |
| `endurance-page-cache.php` | Endurance Page Cache | `2.2` |
| `sso.php` | SSO | `0.4` |

## Environment Variables

The existing WordPress config sample uses standard `wp-config.php` constants. The `.env.example` file is a safe placeholder inventory for maintainers; the current codebase does not include a root dotenv loader.

Placeholders in `.env.example`:

```txt
DB_NAME
DB_USER
DB_PASSWORD
DB_HOST
DB_CHARSET
DB_COLLATE
WP_HOME
WP_SITEURL
WP_ENVIRONMENT_TYPE
WP_DEBUG
WP_DEBUG_LOG
WP_DEBUG_DISPLAY
AUTH_KEY
SECURE_AUTH_KEY
LOGGED_IN_KEY
NONCE_KEY
AUTH_SALT
SECURE_AUTH_SALT
LOGGED_IN_SALT
NONCE_SALT
```

Do not commit `.env` or real `citrus/wp-config.php` values.

## Local Setup

This repository does not provide a one-command local environment. Use an existing WordPress-capable local stack such as Apache/Nginx plus PHP and MySQL/MariaDB.

1. Configure your web server document root to `citrus/`.
2. Copy `citrus/wp-config-sample.php` to `citrus/wp-config.php`.
3. Fill `citrus/wp-config.php` with local database credentials and freshly generated WordPress salts.
4. Create a local MySQL/MariaDB database.
5. Import a sanitized copy of the WordPress database.
6. Set the local site URL in the database or config to the URL assigned by your web server.
7. Open the configured local URL in a browser.

No local URL is hardcoded in this repository. Use the URL from your local web server and keep `home` / `siteurl` aligned with it.

## Database Setup

The detected SQL export is `citrusl1_WPHOK.sql`. It is ignored by Git and should be treated as sensitive until sanitized.

Before sharing or committing any database file:

- Remove or replace private URLs.
- Remove or anonymize WordPress users and emails.
- Remove password hashes, sessions, tokens, transients, and plugin credentials.
- Confirm plugin options do not contain API keys, SMTP credentials, license keys, or webhook secrets.

The SQL dump shows:

- Active theme: `citrus`
- Current theme: `ConnectedWing`
- Front page mode: static page
- Front page ID: `2`
- Permalink structure: empty/default
- Active plugin list matching the table above

## Available Commands

These commands were verified in the local environment:

```powershell
php -v
composer --version
node -v
npm.cmd -v
git status --ignored
php -l citrus\wp-content\themes\citrus\functions.php
php -l citrus\wp-content\mu-plugins\sso.php
php -l citrus\wp-content\mu-plugins\endurance-page-cache.php
```

There are no root Composer scripts, npm scripts, frontend build scripts, migration commands, seeders, or test commands in this repository.

## Build Process

No root build process was detected. Do not run `npm install`, `npm run build`, or `composer install` at the repository root because there is no root `package.json` or `composer.json`.

Package manifests inside `citrus/wp-content/themes/twenty*`, `citrus/wp-content/plugins/Ultimate_VC_Addons`, `citrus/wp-content/plugins/elfsight-form-builder-cc/api`, and `citrus/wp-includes/sodium_compat` belong to bundled WordPress/theme/plugin code. Treat them as vendor or bundled component metadata unless you are intentionally maintaining that specific component.

## Test And Quality Checks

No project test suite was detected.

Use PHP syntax checks for targeted maintenance work:

```powershell
php -l citrus\wp-content\themes\citrus\functions.php
php -l citrus\wp-content\mu-plugins\sso.php
php -l citrus\wp-content\mu-plugins\endurance-page-cache.php
```

During readiness work, PHP lint passed for the active theme and MU plugin entry files checked above. A broader lint of the active theme and MU plugins also passed, but there is no committed automated test runner.

## Authentication And Integrations

- WordPress core provides the primary login/session system.
- `citrus/wp-content/mu-plugins/sso.php` adds SSO behavior through AJAX callbacks.
- Elfsight widget plugins are present for countdown, form builder, and social media icons.
- The database content uses Elfsight and WPBakery shortcodes.
- No payment plugin directory was detected.
- WooCommerce template overrides exist in the theme, but the WooCommerce plugin itself was not detected.

Review all plugin settings in WordPress admin before production use, especially SSO, forms, social widgets, and any premium plugin license fields.

## GitHub Safety

The `.gitignore` intentionally excludes:

- `.env` and `.env.*`
- `citrus/wp-config.php`
- `citrus/wp-content/uploads/`
- WordPress cache, upgrade, backup, Updraft, AI1WM, and Wordfence log folders
- SQL dumps
- Logs
- Archive files such as `.zip`, `.tar`, and `.tar.gz`
- Root `node_modules/`, `/vendor/`, `/dist/`, and `/build/`
- IDE and OS metadata

Known ignored local artifacts include:

- `citrusl1_WPHOK.sql`
- `citrus/wp-content/uploads/`
- `citrus/error_log`
- `citrus/wp-admin/error_log`
- `citrus/wp-content/error_log`
- `citrus/wp-includes/blocks/error_log`
- `citrus/wp-content/plugins/unlimited-addons-for-wpbakery-page-builder/provider/core/addons_install/starter_pack_vc_addons.zip`

Rotate any real database credentials, salts, passwords, API keys, SMTP credentials, plugin license keys, or tokens that may have existed in local files before publishing.

## Maintenance Notes

- Preserve premium/bundled plugins unless you have license access and a verified update path.
- Do not blindly update WordPress core, The7, WPBakery, Slider Revolution, Ultimate Addons, or Elfsight plugins.
- Test updates in a local or staging environment with a database copy before applying them to production.
- Review `sso.php` before production use; it exposes unauthenticated AJAX callbacks gated by transient tokens.
- Keep `citrus/wp-config.php` local-only.
- Keep media uploads and database exports out of Git unless a maintainer explicitly approves a sanitized artifact.

## Deployment

No deployment configuration was detected in this repository. There is no Dockerfile, `docker-compose.yml`, CI workflow, hosting manifest, or deployment script.

Deployments should follow the hosting provider's WordPress process and must keep production secrets outside Git.
