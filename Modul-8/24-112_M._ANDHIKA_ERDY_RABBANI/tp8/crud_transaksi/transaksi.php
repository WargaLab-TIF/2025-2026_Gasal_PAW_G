<?php
require_once "../session.php";
deny_if_not_logged_in();
require_once "../conn.php";
include "../navbar.php";

$q = $conn->query("
    SELECT t.*, p.nama AS nama_pelanggan, u.nama AS nama_user
    FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
    JOIN user u ON t.user_id = u.id_user
    ORDER BY t.id DESC
");
?>
<h2>Data Transaksi</h2>
<a href="tambah.php">Tambah Transaksi</a>

<table border="1" cellpadding="6">
<tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Pelanggan</th>
    <th>User</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

<?php while($t=$q->fetch_assoc()): ?>
<tr>
    <td><?= $t['id'] ?></td>
    <td><?= $t['waktu_transaksi'] ?></td>
    <td><?= $t['nama_pelanggan'] ?></td>
    <td><?= $t['nama_user'] ?></td>
    <td><?= number_format($t['total']) ?></td>
    <td>
        <a href="detail.php?id=<?= $t['id'] ?>">Detail</a> |
        <a href="hapus.php?id=<?= $t['id'] ?>" onclick="return confirm('Hapus transaksi?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
