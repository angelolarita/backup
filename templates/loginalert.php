<div id="form-container">
    <div id="login-form">
        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>
        <script>
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 2000);
        </script>
        <?php unset($_SESSION['success']);
        endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mt-3">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']);
        endif; ?>