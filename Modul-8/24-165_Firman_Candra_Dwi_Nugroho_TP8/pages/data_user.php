<?php
include "config.php";

$level = $_SESSION['level'];

// Tambah user (hanya owner)
if (isset($_POST['simpan']) && $level == 1) {
    mysqli_query($conn, "INSERT INTO user(username, password, level) VALUES(
        '$_POST[username]', md5('$_POST[password]'), '$_POST[level]'
    )");

    echo "<script>alert('User ditambahkan'); location='index.php?page=data_user';</script>";
}

// Hapus user (hanya owner)
if (isset($_GET['hapus']) && $level == 1) {
    mysqli_query($conn, "DELETE FROM user WHERE id=$_GET[hapus]");
    echo "<script>alert('User dihapus'); location='index.php?page=data_user';</script>";
}
?>

<h2>Data User</h2>

<?php if ($level == 1): ?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="level">
        <option value="1">Owner</option>
        <option value="2">Kasir</option>
    </select>
    <button name="simpan">Tambah User</button>
</form>
<br>
<?php endif; ?>

<table border="1" cellpadding="5" width="100%">
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Level</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($conn, "SELECT * FROM user");
$no = 1;

while ($row = mysqli_fetch_assoc($q)) :
?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['level'] == 1 ? "Owner" : "Kasir" ?></td>
    <td>
        <?php if ($level == 1): ?>
            <a href="index.php?page=data_user&hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
        <?php else: ?>
            ❌ Tidak diizinkan
        <?php endif; ?>
    </td>
</tr>

<?php endwhile; ?>
</table>
