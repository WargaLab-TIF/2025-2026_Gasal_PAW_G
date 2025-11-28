<?php 
    include "fungsi.php";

    session_start();
    if($_SESSION) {
        header('location: admin.php');
    }

    $error = [];
    $error['login'] = "";
    if(isset($_POST['submit'])) {
        validateLogin(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']), $error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <form action="" method="POST">
            <h3>Login</h3>
            <p style="color:red"><?php echo $error['login'] ?></p>
            <p>Username</p>
            <input type="text" name="username" value="<?php echo $_POST['username'] ?? '' ?>">
            <p>Password</p>
            <input type="password" name="password" value="<?php echo $_POST['password'] ?? '' ?>">
            <input type="submit" value="submit" name="submit">
        </form>
    </div>
</body>
</html>