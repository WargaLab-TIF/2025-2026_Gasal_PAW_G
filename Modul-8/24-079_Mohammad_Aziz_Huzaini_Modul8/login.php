<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] === true){
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>
    <h2>Form Login</h2>
    <form action="proses_login.php" method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>