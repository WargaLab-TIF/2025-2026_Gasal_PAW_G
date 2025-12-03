<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";

$id = $_GET['id'];
$u = $conn->query("SELECT * FROM user WHERE id_user=$id")->fetch_assoc();
?>
<h2>Edit User</h2>

<form method="post">
    Username:<br>
    <input type="text" name="username" value="<?= $u['username'] ?>" required><br><br>

    Password (isi jika ingin ganti):<br>
    <input type="password" name="password"><br><br>

    Nama:<br>
    <input type="text" name="nama" value="<?= $u['nama'] ?>" required><br><br>

    Alamat:<br>
    <textarea name="alamat"><?= $u['alamat'] ?></textarea><br><br>

    HP:<br>
    <input type="text" name="hp" value="<?= $u['hp'] ?>"><br><br>

    Level:<br>
    <select name="level">
        <option value="1" <?= $u['level']==1?"selected":"" ?>>Owner</option>
        <option value="2" <?= $u['level']==2?"selected":"" ?>>Kasir</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>

<?php
if ($_POST) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];

    if ($pass == "") {
        $conn->query("
            UPDATE user SET
                username='$user',
                nama='$nama',
                alamat='$alamat',
                hp='$hp',
                level=$level
            WHERE id_user=$id
        ");
    } else {
        $conn->query("
            UPDATE user SET
                username='$user',
                password='$pass',
                nama='$nama',
                alamat='$alamat',
                hp='$hp',
                level=$level
            WHERE id_user=$id
        ");
    }

    header("Location: data_user.php");
}
?>
