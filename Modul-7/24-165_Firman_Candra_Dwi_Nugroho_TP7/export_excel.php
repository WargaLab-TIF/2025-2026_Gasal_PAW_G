<?php
include "config.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$dari   = $_GET['dari'] ?? '';
$sampai = $_GET['sampai'] ?? '';


$q = mysqli_query($conn,
"SELECT t.tanggal, b.nama_barang, d.qty, d.subtotal 
 FROM transaksi t
 JOIN transaksi_detail d ON d.id_transaksi = t.id
 JOIN barang b ON b.id = d.id_barang
 WHERE tanggal BETWEEN '$dari' AND '$sampai'"
);
?>

<h2>Laporan Penjualan</h2>
<p>Periode: <?= $dari ?> s/d <?= $sampai ?></p>

<table border="1">
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
        <td><?= $r['subtotal'] ?></td>
    </tr>
    <?php } ?>
</table>
