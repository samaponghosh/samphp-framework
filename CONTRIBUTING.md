# Contributing to SamPHP Framework

Thank you for considering contributing to SamPHP! We welcome all contributions — bug reports, feature requests, documentation improvements, and code changes.

## How to Contribute

### Reporting Bugs

1. Check the [Issues](https://github.com/samaponghosh/samphp-framework/issues) page to see if the bug has already been reported.
2. If not, create a new issue with:
   - A clear, descriptive title
   - Steps to reproduce the bug
   - Expected vs. actual behavior
   - PHP version and server environment

### Suggesting Features

Open an issue with the `enhancement` label describing:
- The problem your feature would solve
- How you envision the implementation
- Any alternatives you've considered

### Submitting Code

1. **Fork** the repository
2. **Create a branch** from `main`:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Make your changes** — follow the existing code style (PSR-12 where applicable)
4. **Test** your changes locally
5. **Commit** with clear, descriptive messages:
   ```bash
   git commit -m "Add: brief description of change"
   ```
6. **Push** your branch:
   ```bash
   git push origin feature/your-feature-name
   ```
7. **Open a Pull Request** against `main`

## Code Style

- Use 4 spaces for indentation
- Follow PSR-12 coding standards where applicable
- Keep methods focused and short
- Add comments for non-obvious logic
- Use meaningful variable and method names

## Directory Guidelines

| Directory | Purpose |
|---|---|
| `app/core/` | Framework internals — modify with care |
| `app/controllers/` | Application controllers |
| `app/models/` | Application models |
| `app/views/` | View templates |
| `app/middleware/` | Request middleware |
| `config/` | Configuration files |
| `public/` | Web-accessible files |

## License

By contributing, you agree that your contributions will be licensed under the [MIT License](LICENSE).
