# Archive Security Notes

The tracked `.wpress` export is a sensitive production-style backup.

Confirmed archive risks:

- The export contains `database.sql`.
- The database dump contains password-hash and email-like material.
- The archive includes uploads, logs, `wflogs`, plugins, themes, and mu-plugins.
- A plugin file contains a hardcoded The Plus Addons Pro purchase-code assignment.
- Commercial/premium code is present in the archive and should only be stored or distributed where licensing allows it.

Required actions after any restore:

- Rotate all WordPress administrator and application user passwords.
- Regenerate WordPress salts and authentication keys.
- Rotate SMTP, payment, OAuth, API, webhook, cloud-storage, and plugin license credentials found in the restored database or files.
- Review `wp_options`, plugin settings, form integrations, and payment/email plugins for stored secrets.
- Keep this repository private unless a sanitized export replaces the current archive.

Do not print full credentials, salts, tokens, password hashes, purchase codes, or database rows in terminal output, tickets, pull requests, or commit messages.
