<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])){ header('Location: data_master_transaksi.php'); exit; }
$id = (int)$_GET['id'];
$r = mysqli_query($conn, "SELECT t.*, p.nama as nama_pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id=p.id WHERE t.id=$id");
$trx = mysqli_fetch_assoc($r);
$details = mysqli_query($conn, "SELECT td.*, b.nama_barang FROM transaksi_detail td LEFT JOIN barang b ON td.barang_id=b.id WHERE td.transaksi_id=$id");
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Detail Transaksi ID <?= $id ?></h2>
    <p>Waktu: <?= $trx['waktu_transaksi'] ?></p>
    <p>Pelanggan: <?= htmlspecialchars($trx['nama_pelanggan']) ?></p>
    <p>Keterangan: <?= htmlspecialchars($trx['keterangan']) ?></p>
    <p>Total: Rp <?= number_format($trx['total'],0,',','.') ?></p>
    <h3>Item</h3>
    <table border='1'>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Qty</th>
        </tr>
        <?php while($d=mysqli_fetch_assoc($details)){ echo "<tr><td>".htmlspecialchars($d['nama_barang'])."</td><td>Rp ".number_format($d['harga'],0,',','.')."</td><td>{$d['qty']}</td></tr>"; } ?>
    </table>
    <a href="data_master_transaksi.php">Kembali</a>
</body>

</html>