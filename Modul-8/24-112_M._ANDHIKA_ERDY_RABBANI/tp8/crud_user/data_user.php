<?php
require_once "../session.php";
deny_if_not_logged_in();
require_level(1);
require "../conn.php";
include "../navbar.php";

$q = $conn->query("SELECT * FROM user");
?>
<h2>Data User</h2>

<a href="tambah.php">+ Tambah User</a>
<br><br>

<table border="1" cellpadding="6">
<tr>
    <th>ID</th><th>Username</th><th>Nama</th><th>Level</th><th>Aksi</th>
</tr>

<?php while ($u = $q->fetch_assoc()): ?>
<tr>
    <td><?= $u['id_user'] ?></td>
    <td><?= $u['username'] ?></td>
    <td><?= $u['nama'] ?></td>
    <td><?= $u['level'] ?></td>
    <td>
        <a href="edit.php?id=<?= $u['id_user'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $u['id_user'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
