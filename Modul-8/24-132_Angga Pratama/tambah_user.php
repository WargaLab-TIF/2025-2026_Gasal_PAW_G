<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
if (isset($_POST['simpan'])) {
    $u = $_POST['username']; $p = md5($_POST['password']); $n = $_POST['nama']; $l = $_POST['level'];
    mysqli_query($koneksi, "INSERT INTO user (username, password, nama, level) VALUES ('$u','$p','$n','$l')");
    header("Location: data_user.php");
}
?>
<h3>Tambah User</h3>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Nama: <input type="text" name="nama" required><br><br>
    Level: <select name="level"><option value="1">Owner</option><option value="2">Kasir</option></select><br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>