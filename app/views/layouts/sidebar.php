<?php
$currentUrl = $_GET['url'] ?? '';
$urlParts = explode('/', $currentUrl);
$activeController = $urlParts[0] ?? 'home';
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">
            <i data-lucide="layout-dashboard" style="color: white; width: 20px;"></i>
        </div>
        <h2 style="font-size: 1.25rem; font-weight: 700;"><?= APP_NAME ?></h2>
    </div>
    
    <nav class="sidebar-nav">
        <a href="<?php echo BASE_URL; ?>/" class="nav-item <?php echo ($activeController === 'home' || $activeController === '') ? 'active' : ''; ?>">
            <i data-lucide="home"></i>
            <span>Home</span>
        </a>
    </nav>
</aside>
