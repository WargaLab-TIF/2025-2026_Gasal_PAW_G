<?php
include 'koneksi.php';
if (isset($_SESSION['level'])) {
    // already logged in - redirect to home
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:420px;margin-top:60px;">
    <h3>Login</h3>
    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger"><?=htmlspecialchars($_SESSION['login_error']); unset($_SESSION['login_error']);?></div>
    <?php endif; ?>
    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>
</body>
</html>
