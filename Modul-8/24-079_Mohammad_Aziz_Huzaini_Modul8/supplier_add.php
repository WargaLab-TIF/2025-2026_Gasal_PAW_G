<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    mysqli_query($conn,"INSERT INTO supplier (nama) VALUES ('".mysqli_real_escape_string($conn,$nama)."')");
    header('Location: supplier_list.php'); exit;
}
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Tambah Supplier</h2>
    <form method='POST'><input name='nama' required><button type='submit'>Simpan</button></form>
    <a href='supplier_list.php'>Kembali</a>
</body>

</html>