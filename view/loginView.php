<div class="login-container">
    <form action="http://localhost/dashboard/controllers/loginController.php" method="POST">
        <?php include_once __DIR__ . '/../templates/loginalert.php'; ?>
        <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
        <div class="alert alert-success">You have successfully logged out.</div>
        <?php endif; ?>
        <header class="text-center mb-3">
            <h2>Login</h2>
        </header>
        <div class="mb-3">
            <label for="userName" class="form-label">Username</label>
            <input type="text" class="form-control" id="userName" name="userName"
                value="<?= isset($_COOKIE['userName']) ? htmlspecialchars($_COOKIE['userName']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                    required>
                <span class="input-group-text" onclick="togglePassword()">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </span>
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                <?= isset($_COOKIE['userName']) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
    </form>
</div>