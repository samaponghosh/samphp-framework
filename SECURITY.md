# Security Policy

## Supported Versions

| Version | Supported |
|---|---|
| 1.0.x | ✅ Active |

## Reporting a Vulnerability

If you discover a security vulnerability in SamPHP Framework, please report it responsibly.

**DO NOT** open a public GitHub issue for security vulnerabilities.

Instead, please email the maintainer directly:

- **Contact**: [Samapon Ghosh via GitHub](https://github.com/samaponghosh)
- **Subject**: `[SECURITY] SamPHP Framework — Brief description`

### What to Include

- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if any)

### Response Timeline

- **Acknowledgment**: Within 48 hours
- **Assessment**: Within 1 week
- **Fix release**: As soon as possible, depending on severity

## Security Best Practices

When using SamPHP Framework, always:

1. **Never commit `config/config.php`** — it contains database credentials
2. **Set `display_errors` to `0`** in production
3. **Use CSRF tokens** on all forms via `Security::csrfToken()`
4. **Sanitize all user input** via `Security::sanitize()`
5. **Use prepared statements** for all database queries (PDO)
6. **Keep PHP updated** to the latest stable version
7. **Set proper file permissions** on `storage/` and `public/uploads/`
