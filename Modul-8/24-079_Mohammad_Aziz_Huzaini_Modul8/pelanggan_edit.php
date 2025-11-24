<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login']) || $_SESSION['level']!=1){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])) header('Location: pelanggan_list.php');
$id=(int)$_GET['id'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    mysqli_query($conn,"UPDATE pelanggan SET nama='".mysqli_real_escape_string($conn,$nama)."' WHERE id=$id");
    header('Location: pelanggan_list.php'); exit;
}
$r=mysqli_query($conn,"SELECT * FROM pelanggan WHERE id=$id"); $row=mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Edit Pelanggan</h2>
    <form method='POST'><input name='nama' value='<?= htmlspecialchars($row['nama']) ?>' required><button
            type='submit'>Update</button></form>
    <a href='pelanggan_list.php'>Kembali</a>
</body>

</html>