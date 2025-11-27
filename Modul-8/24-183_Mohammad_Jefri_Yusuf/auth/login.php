<?php 
session_start();

if(isset($_SESSION["login"]) ) {
    header("Location: ../index.php");
    exit;
};

$old_username = '';
if (isset($_SESSION["old_username"])) {
    $old_username = htmlspecialchars($_SESSION["old_username"]);
    unset($_SESSION["old_username"]);
}

$old_password = '';
if (isset($_SESSION["old_password"])) {
    $old_password = htmlspecialchars($_SESSION["old_password"]);
    unset($_SESSION["old_password"]);
}
$error_message = '';
if (isset($_SESSION["error"])) {
    $error_message = $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Login Sistem</h1>
        <div class="content">
            <?php if(!empty($error_message)): ?>
            <div class="error-messege">
                <?= $error_message; ?>
            </div>
            <?php endif; ?>
            <form action="proses_login.php" method="POST">
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan username" value="<?= $old_username; ?>">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" value="<?= $old_password; ?>">
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>