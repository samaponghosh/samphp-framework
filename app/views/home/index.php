<?php require APPROOT . '/views/layouts/header.php'; ?>
<?php require APPROOT . '/views/layouts/navbar.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4"><?= htmlspecialchars($data['title']); ?></h1>
            <p class="lead mt-3"><?= htmlspecialchars($data['description']); ?></p>
            
            <div class="mt-5 p-4 bg-light rounded shadow-sm">
                <h3>Getting Started</h3>
                <p class="text-muted">Edit <code>app/controllers/HomeController.php</code> and <code>app/views/home/index.php</code> to start building your application.</p>
                <p class="text-muted">Your configuration is located in <code>config/config.php</code>.</p>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
