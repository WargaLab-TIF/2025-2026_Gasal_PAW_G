<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html><body style="font-family:sans-serif; padding:20px;">
<h2>Data Supplier</h2>
<a href="index.php">Kembali</a> | <a href="tambah_supplier.php" style="color:green;">+ Tambah Supplier</a>
<table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top:10px; border-collapse:collapse;">
    <tr style="background:#333; color:white;"><th>No</th><th>Nama Supplier</th><th>Alamat</th><th>Telp</th><th>Aksi</th></tr>
    <?php
    $q = mysqli_query($koneksi, "SELECT * FROM supplier"); $no=1;
    while($r = mysqli_fetch_assoc($q)){
        echo "<tr><td>".$no++."</td><td>".$r['nama_supplier']."</td><td>".$r['alamat']."</td><td>".$r['telp']."</td>
        <td><a href='edit_supplier.php?id=".$r['id_supplier']."'>Edit</a> | <a href='hapus_supplier.php?id=".$r['id_supplier']."' onclick='return confirm(\"Yakin?\")' style='color:red;'>Hapus</a></td></tr>";
    }
    ?>
</table></body></html>