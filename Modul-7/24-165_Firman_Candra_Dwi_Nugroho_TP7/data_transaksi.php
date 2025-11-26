<?php 
include "config.php";

$q = mysqli_query($conn,
"SELECT t.id, p.nama AS pelanggan, tanggal, total
 FROM transaksi t
 JOIN pelanggan p ON t.id_pelanggan = p.id
 ORDER BY t.id DESC");

?>

<h2>Data Transaksi</h2>
<table border="1" cellpadding="7">
    <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Laporan</th>
    </tr>

    <?php $no=1; while($r=mysqli_fetch_assoc($q)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['pelanggan'] ?></td>
        <td><?= $r['tanggal'] ?></td>
        <td><?= number_format($r['total']) ?></td>
        <td><a href="report_transaksi.php?id=<?= $r['id'] ?>">Lihat</a></td>
    </tr>
    <?php } ?>
</table>
