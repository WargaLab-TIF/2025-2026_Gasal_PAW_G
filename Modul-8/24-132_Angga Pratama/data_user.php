<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html><body style="font-family:sans-serif; padding:20px;">
<h2>Data User</h2>
<a href="index.php">Kembali</a> | <a href="tambah_user.php" style="color:green;">+ Tambah User</a>
<table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top:10px; border-collapse:collapse;">
    <tr style="background:#333; color:white;"><th>No</th><th>Username</th><th>Nama</th><th>Level</th><th>Aksi</th></tr>
    <?php
    $q = mysqli_query($koneksi, "SELECT * FROM user"); $no=1;
    while($r = mysqli_fetch_assoc($q)){
        echo "<tr><td>".$no++."</td><td>".$r['username']."</td><td>".$r['nama']."</td><td>".(($r['level']==1)?'Owner':'Kasir')."</td>
        <td><a href='edit_user.php?id=".$r['id_user']."'>Edit</a> | <a href='hapus_user.php?id=".$r['id_user']."' onclick='return confirm(\"Yakin?\")' style='color:red;'>Hapus</a></td></tr>";
    }
    ?>
</table></body></html>