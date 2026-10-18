<?php
$content = ob_start();
?>

<div class="container py-5" style="max-width: 420px;">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-3 text-center">Admin Login</h4>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="post" action="<?php echo BASE_URL; ?>/admin/login">
                <div class="mb-3">
                    <label for="username" class="form-label">Username or Email</label>
                    <input type="text" class="form-control" id="username" name="username" required autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <p class="text-center mt-3 mb-0">
        <a href="<?php echo BASE_URL; ?>">← Back to site</a>
    </p>
    <?php if (APP_ENV === 'development'): ?>
       
    <?php endif; ?>
    
</div>

<?php
$content = ob_get_clean();
include BASE_PATH . '/app/Views/admin/layouts/admin.php';
?>


