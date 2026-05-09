# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/), and this project adheres to [Semantic Versioning](https://semver.org/).

## [1.0.0] - 2026-05-10

### Added
- MVC architecture with front-controller pattern
- Core routing via URL parsing with controller/method/params resolution
- Base `Controller` class with `view()`, `model()`, `redirect()`, and `json()` helpers
- Base `Model` class with PDO database connection
- `Database` class with PDO (MySQL) singleton pattern and true prepared statements
- `Security` class: CSRF token generation/verification, XSS sanitization, bcrypt password hashing
- `Session` class: start, get, set, has, destroy, regenerate, flash messages
- `Validator` class: required, email, min, max, numeric, url, matches (regex)
- `Mailer` class: basic PHP mail() implementation (extendable)
- `Router` class: extensible route registration (GET/POST)
- Middleware system: `AuthMiddleware`, `GuestMiddleware`, `RoleMiddleware`
- Layout system: header, footer, navbar, sidebar templates
- Modern CSS design system with CSS custom properties
- JavaScript utility library: toast notifications, modals, AJAX helpers, form submission, date/currency formatting
- Apache `.htaccess` routing for clean URLs
- Security: directory listing disabled, sensitive file access blocked
- Sample configuration file with auto-copy on `composer create-project`
- `.gitattributes` for Composer export-ignore (smaller downloads)
- `CONTRIBUTING.md` and `SECURITY.md` for open-source best practices
- Absolute path resolution via `ROOTPATH` and `APPROOT` constants
