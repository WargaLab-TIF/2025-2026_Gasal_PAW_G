<?php
require_once 'config.php';

// Jika sudah login, redirect ke home
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // MD5 untuk password
    
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['level'] = $user['level'];
        
        // Redirect ke home
        header('Location: index.php');
        exit();
    } else {
        $error = 'Username atau Password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1 class="login-title">Login Admin</h1>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="login.php">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

