<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html><body style="font-family:sans-serif; padding:20px;">
<h2>Data Barang</h2>
<a href="index.php">Kembali</a> | <a href="tambah_barang.php" style="color:green;">+ Tambah Barang</a>
<table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top:10px; border-collapse:collapse;">
    <tr style="background:#333; color:white;"><th>No</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
    <?php
    $q = mysqli_query($koneksi, "SELECT * FROM barang"); $no=1;
    while($r = mysqli_fetch_assoc($q)){
        echo "<tr>
            <td>".$no++."</td>
            <td>".$r['nama_barang']."</td>
            <td>Rp ".number_format($r['harga'],0,',','.')."</td>
            <td>".$r['stok']."</td>
            <td>
                <a href='edit_barang.php?id=".$r['id_barang']."'>Edit</a> | 
                <a href='hapus_barang.php?id=".$r['id_barang']."' onclick='return confirm(\"Yakin?\")' style='color:red;'>Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table></body></html>