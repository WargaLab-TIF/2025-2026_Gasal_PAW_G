<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])) header('Location: supplier_list.php');
$id=(int)$_GET['id'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    mysqli_query($conn,"UPDATE supplier SET nama='".mysqli_real_escape_string($conn,$nama)."' WHERE id=$id");
    header('Location: supplier_list.php'); exit;
}
$r=mysqli_query($conn,"SELECT * FROM supplier WHERE id=$id");
$row=mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Edit Supplier</h2>
    <form method='POST'><input name='nama' value='<?= htmlspecialchars($row['nama']) ?>' required><button
            type='submit'>Update</button></form>
    <a href='supplier_list.php'>Kembali</a>
</body>

</html>