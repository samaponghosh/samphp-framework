<p align="center">
  <strong>SamPHP Framework</strong><br>
  A lightweight, secure, MVC-based PHP framework for building CRMs, websites, and APIs.
</p>

<p align="center">
  <a href="https://packagist.org/packages/samphp/framework"><img src="https://img.shields.io/packagist/v/samphp/framework.svg?style=flat-square" alt="Latest Version"></a>
  <a href="https://packagist.org/packages/samphp/framework"><img src="https://img.shields.io/packagist/dt/samphp/framework.svg?style=flat-square" alt="Total Downloads"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square" alt="License"></a>
  <img src="https://img.shields.io/badge/php-%3E%3D7.4-8892BF.svg?style=flat-square" alt="PHP Version">
</p>

---

## ✨ Features

- **MVC Architecture** — Clean separation of Models, Views, and Controllers
- **Built-in Security** — CSRF protection, XSS sanitization, bcrypt password hashing
- **Session Management** — Secure session handling with regeneration & flash messages
- **Middleware System** — Auth, Guest, and Role-based access control out of the box
- **Input Validation** — Server-side validation (required, email, min, max, numeric, url, regex)
- **PDO Database Layer** — Secure MySQL connection with singleton pattern & prepared statements
- **Modern Frontend** — Outfit font, Lucide icons, toast notifications, modal system
- **AJAX Utilities** — Built-in JavaScript helpers for API calls and form handling
- **Clean URLs** — Apache mod_rewrite routing with directory protection
- **Zero Dependencies** — Pure PHP, no external packages required

## 📦 Installation

### Via Composer (Recommended)

```bash
composer create-project samphp/framework your-project-name
```

This will:
1. Download the framework template
2. Auto-create `config/config.php` from the sample
3. Display next-step instructions

### Manual Installation

```bash
git clone https://github.com/samaponghosh/samphp-framework.git your-project-name
cd your-project-name
cp config/config.sample.php config/config.php
```

## ⚙️ Configuration

Edit `config/config.php` with your settings:

```php
// Application
define('APP_NAME', 'My Application');
define('BASE_URL', 'http://localhost/your-project-name/public');

// Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database');
define('DB_USER', 'root');
define('DB_PASS', '');

// Timezone
date_default_timezone_set('UTC');

// Error Reporting — Set to 0 in production!
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📂 Project Structure

```
your-project-name/
├── app/
│   ├── controllers/        # Your controllers
│   │   └── HomeController.php
│   ├── core/               # Framework core (do not modify)
│   │   ├── App.php         # Front controller & URL router
│   │   ├── Controller.php  # Base controller class
│   │   ├── Database.php    # PDO database connection (singleton)
│   │   ├── Mailer.php      # Email helper (extendable)
│   │   ├── Model.php       # Base model class
│   │   ├── Router.php      # Route definitions (extendable)
│   │   ├── Security.php    # CSRF, XSS, password hashing
│   │   ├── Session.php     # Session management + flash messages
│   │   └── Validator.php   # Input validation
│   ├── middleware/          # Request middleware
│   │   ├── AuthMiddleware.php
│   │   ├── GuestMiddleware.php
│   │   └── RoleMiddleware.php
│   ├── models/             # Your models
│   └── views/              # Your views
│       ├── home/
│       │   └── index.php
│       └── layouts/
│           ├── header.php
│           ├── footer.php
│           ├── navbar.php
│           └── sidebar.php
├── config/
│   ├── config.sample.php   # Template config (committed)
│   ├── constants.php       # Path constants (auto-resolved)
│   └── database.php        # Database bootstrap
├── public/                 # Web root (point your server here)
│   ├── assets/
│   │   ├── css/style.css
│   │   ├── js/main.js
│   │   └── images/
│   ├── uploads/            # User uploads
│   ├── .htaccess
│   └── index.php           # Application entry point
├── storage/
│   ├── cache/
│   ├── logs/
│   └── mail_attachments/
├── .htaccess               # Root redirect to public/
├── composer.json
├── LICENSE
└── README.md
```

## 🚀 Quick Start

### 1. Create a Controller

```php
// app/controllers/ProductController.php
<?php

class ProductController extends Controller
{
    public function index()
    {
        $productModel = $this->model('Product');
        $products = $productModel->getAll();

        $this->view('product/index', ['products' => $products]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Security::verifyCsrf($_POST['csrf_token']);

            $name = Security::sanitize($_POST['name']);
            // ... save to database
        }

        $this->view('product/create');
    }
}
```

### 2. Create a Model

```php
// app/models/Product.php
<?php

class Product extends Model
{
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
        return $stmt->execute([$data['name'], $data['price']]);
    }
}
```

### 3. Create a View

```php
<!-- app/views/product/index.php -->
<?php require APPROOT . '/views/layouts/header.php'; ?>
<?php require APPROOT . '/views/layouts/navbar.php'; ?>

<div class="main-content">
    <h1>Products</h1>

    <?php foreach ($products as $product): ?>
        <div class="card">
            <h3><?= htmlspecialchars($product['name']); ?></h3>
            <p><?= htmlspecialchars($product['price']); ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
```

### 4. Using Middleware

```php
// In any controller method
class DashboardController extends Controller
{
    public function index()
    {
        AuthMiddleware::handle();  // Requires login
        // RoleMiddleware::handle(['admin', 'editor']);  // Role-based access

        $this->view('dashboard/index');
    }
}
```

### 5. Flash Messages

```php
// In a controller — set a flash message
Session::flash('success', 'Product created successfully!');
$this->redirect('/product');

// In a view — display it
<?php if ($msg = Session::getFlash('success')): ?>
    <div class="alert alert-success"><?= htmlspecialchars($msg); ?></div>
<?php endif; ?>
```

## 🔒 Security Features

| Feature | Usage |
|---|---|
| CSRF Protection | `Security::csrfToken()` / `Security::verifyCsrf($token)` |
| XSS Sanitization | `Security::sanitize($input)` |
| Password Hashing | `Security::hashPassword($pw)` / `Security::verifyPassword($pw, $hash)` |
| Session Security | `Session::regenerate()` after login |
| Directory Protection | `.htaccess` blocks access to sensitive files |
| Prepared Statements | PDO with emulated prepares disabled |

## 🌐 URL Routing

URLs map automatically to controllers and methods:

| URL | Controller | Method | Parameters |
|---|---|---|---|
| `/` | `HomeController` | `index()` | — |
| `/product` | `ProductController` | `index()` | — |
| `/product/show/5` | `ProductController` | `show(5)` | `[5]` |
| `/user/edit/3` | `UserController` | `edit(3)` | `[3]` |

## 🖥️ Server Requirements

- PHP >= 7.4
- MySQL 5.7+ / MariaDB 10.3+
- Apache with `mod_rewrite` enabled
- PDO PHP extension
- mbstring PHP extension

## 🤝 Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 🔐 Security

If you discover a security vulnerability, please see [SECURITY.md](SECURITY.md) for responsible disclosure guidelines.

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

## 👤 Author

**Samapon Ghosh** — [@samaponghosh](https://github.com/samaponghosh)

---

<p align="center">
  Built with ❤️ by Samapon Ghosh
</p>
