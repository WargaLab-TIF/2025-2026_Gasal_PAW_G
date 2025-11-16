<?php
include "config.php";

$d1 = $_GET['dari'];
$d2 = $_GET['sampai'];

$q = mysqli_query($conn,
"SELECT t.tanggal, b.nama_barang, d.qty, d.subtotal 
 FROM transaksi t
 JOIN transaksi_detail d ON d.id_transaksi = t.id
 JOIN barang b ON b.id = d.id_barang
 WHERE tanggal BETWEEN '$d1' AND '$d2'"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Print Laporan</title>
</head>
<body onload="window.print()">

<h2>Laporan Penjualan</h2>
<p>Periode: <?= $d1 ?> s/d <?= $d2 ?></p>

<table border="1" cellspacing="0" cellpadding="7" width="100%">
    <tr>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

    <?php while($r=mysqli_fetch_assoc($q)) { ?>
    <tr>
        <td><?= $r['tanggal'] ?></td>
        <td><?= $r['nama_barang'] ?></td>
        <td><?= $r['qty'] ?></td>
        <td><?= number_format($r['subtotal']) ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
