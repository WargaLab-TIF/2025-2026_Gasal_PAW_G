<?php
require_once "../session.php";
deny_if_not_logged_in();
require_level(1);
require "../conn.php";
include "../navbar.php";

$q = $conn->query("SELECT * FROM supplier");
?>
<h2>Data Supplier</h2>

<a href="tambah.php">+ Tambah Supplier</a>
<br><br>

<table border="1" cellpadding="6">
<tr>
    <th>ID</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Aksi</th>
</tr>

<?php while ($s = $q->fetch_assoc()): ?>
<tr>
    <td><?= $s['id'] ?></td>
    <td><?= $s['nama'] ?></td>
    <td><?= $s['telp'] ?></td>
    <td><?= $s['alamat'] ?></td>
    <td>
        <a href="edit.php?id=<?= $s['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $s['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
