<?php
session_start();

if (isset($_SESSION['id_user'])) {
    if ($_SESSION['level'] == 1) {
        header("Location: owner.php");
        exit;
    } elseif ($_SESSION['level'] == 2) {
        header("Location: kasir.php");
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Username atau password salah.</p>
<?php endif; ?>

<form action="cek_login.php" method="post">
    <label>Username<br>
        <input type="text" name="username" required>
    </label><br><br>

    <label>Password<br>
        <input type="password" name="password" required>
    </label><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
