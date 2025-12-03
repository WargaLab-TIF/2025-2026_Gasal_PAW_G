<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow" style="width: 360px;">
            <h3 class="text-center mb-4">Login</h3>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
            </form>

            <?php
            if (isset($error)) {
                echo '<div class="alert alert-danger mt-3 text-center p-2">' . htmlspecialchars($error) . '</div>';
            }
            ?>

            <?php require_once '../data_base/autentikasi/verif_login.php'; ?>
        </div>
    </div>
</body>
</html>