<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>
<?php include 'koneksi.php'; ?>

<h2>Data User</h2>
<a href="user_tambah.php">+ Tambah User</a>
<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th><th>Username</th><th>Nama</th><th>Level</th><th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM user");
while($d = mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?= $d['id'] ?></td>
    <td><?= $d['username'] ?></td>
    <td><?= $d['nama_lengkap'] ?></td>
    <td><?= $d['level'] ?></td>
    <td>
        <a href="user_edit.php?id=<?= $d['id'] ?>">Edit</a> |
        <a href="user_hapus.php?id=<?= $d['id'] ?>" onclick="return confirm('Hapus user?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
