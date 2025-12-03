<?php
require_once "../session.php";
deny_if_not_logged_in();
require_once "../conn.php";
include "../navbar.php";

$id = $_GET['id'];

$t = $conn->query("
    SELECT t.*, p.nama AS nama_pelanggan, u.nama AS nama_user
    FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
    JOIN user u ON t.user_id = u.id_user
    WHERE t.id=$id
")->fetch_assoc();

$d = $conn->query("
    SELECT td.*, b.nama_barang 
    FROM transaksi_detail td
    JOIN barang b ON td.barang_id = b.id
    WHERE td.transaksi_id=$id
");
?>
<h2>Detail Transaksi #<?= $id ?></h2>

Pelanggan : <?= $t['nama_pelanggan'] ?> <br>
User      : <?= $t['nama_user'] ?> <br>
Tanggal   : <?= $t['waktu_transaksi'] ?> <br>
Keterangan: <?= $t['keterangan'] ?> <br><br>

<table border="1" cellpadding="7">
<tr>
    <th>Barang</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
</tr>

<?php while($x = $d->fetch_assoc()): ?>
<tr>
    <td><?= $x['nama_barang'] ?></td>
    <td><?= number_format($x['harga']) ?></td>
    <td><?= $x['qty'] ?></td>
    <td><?= number_format($x['harga'] * $x['qty']) ?></td>
</tr>
<?php endwhile; ?>
</table>

<br>
<b>Total: Rp <?= number_format($t['total']) ?></b>
<br><br>
<a href="transaksi.php">Kembali</a>
