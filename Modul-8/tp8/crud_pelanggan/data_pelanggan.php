<?php
require_once "../session.php";
deny_if_not_logged_in();
require_level(1);
require "../conn.php";
include "../navbar.php";

$q = $conn->query("SELECT * FROM pelanggan");
?>
<h2>Data Pelanggan</h2>

<a href="tambah.php">+ Tambah Pelanggan</a>
<br><br>

<table border="1" cellpadding="6">
<tr>
    <th>ID</th><th>Nama</th><th>JK</th><th>Telp</th><th>Alamat</th><th>Aksi</th>
</tr>

<?php while ($p = $q->fetch_assoc()): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['nama'] ?></td>
    <td><?= $p['jenis_kelamin'] ?></td>
    <td><?= $p['telp'] ?></td>
    <td><?= $p['alamat'] ?></td>
    <td>
        <a href="edit.php?id=<?= $p['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $p['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
