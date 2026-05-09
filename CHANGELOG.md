# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/), and this project adheres to [Semantic Versioning](https://semver.org/).

## [1.0.0] - 2026-05-10

### Added
- MVC architecture with front-controller pattern
- Core routing via URL parsing with controller/method/params resolution
- Base `Controller` class with `view()`, `model()`, `redirect()`, and `json()` helpers
- Base `Model` class with PDO database connection
- `Database` class with PDO (MySQL) singleton connection
- `Security` class: CSRF token generation/verification, XSS sanitization, bcrypt password hashing
- `Session` class: start, get, set, has, destroy, regenerate
- `Validator` class: required, email, min, max, numeric
- `Mailer` class: placeholder for email functionality
- Middleware system: `AuthMiddleware`, `GuestMiddleware`, `RoleMiddleware`
- Layout system: header, footer, navbar, sidebar templates
- Modern CSS design system with CSS custom properties
- JavaScript utility library: toast notifications, modals, AJAX helpers, form submission, date/currency formatting
- Apache `.htaccess` routing for clean URLs
- Security headers: directory listing disabled, sensitive file access blocked
- Sample configuration file with auto-copy on `composer create-project`
