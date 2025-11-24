<?php session_start();if(isset($_SESSION['login'])){header('Location: index.php');exit;}?>
<!DOCTYPE html><html><head>
<title>Login</title>
<link rel='stylesheet' href='assets/css/style.css'></head>
<body><h2>Login User</h2><form method='POST' action='proses_login.php'>
    <label>Username</label><br><input type='text' name='username' required>
    <br><br><label>Password</label><br><input type='password' name='password' required><br><br>
    <button type='submit'>LOGIN</button></form></body></html>