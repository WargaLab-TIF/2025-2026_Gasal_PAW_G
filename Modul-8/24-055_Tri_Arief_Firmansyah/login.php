<?php
session_start();
if(isset($_SESSION['level'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" style="max-width:420px; margin:40px auto;">
  <h2>Login Sistem</h2>
  <form action="login_proses.php" method="POST">
    <div class="form-row">
      <label>Username</label>
      <input type="text" name="username" required>
    </div>
    <div class="form-row">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>
    <button class="btn" type="submit">Login</button>
  </form>
</div>
</body>
</html>
