<?php
session_start();
include "../koneksi.php";

if (isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $u = $_POST['username'];
    $p = ($_POST['password']); 

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$u'");
    $d = mysqli_fetch_assoc($query);

    if ($d) {

        if ($d['password'] === $p || md5($p, $d['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $d['id_user'];
            $_SESSION['username'] = $d['username'];
            $_SESSION['nama'] = $d['nama'];
            $_SESSION['level'] = $d['level'];

            header("Location: ../index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Halaman Login</h2>

<?php if ($error != "") echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
