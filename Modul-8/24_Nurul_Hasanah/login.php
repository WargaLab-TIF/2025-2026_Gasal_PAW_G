<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
    <h2>Silakan Masuk</h2>
        <form action="login_cek.php" method="post">
            Username : <input type="text" name="username" required><br><br>
            Password : <input type="password" name="password" required><br><br>
            <button type="submit">Masuk</button>
</form>
</body>
</html>