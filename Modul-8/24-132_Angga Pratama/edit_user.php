<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'"));
if (isset($_POST['update'])) {
    $u = $_POST['username']; $n = $_POST['nama']; $l = $_POST['level'];
    mysqli_query($koneksi, "UPDATE user SET username='$u', nama='$n', level='$l' WHERE id_user='$id'");
    header("Location: data_user.php");
}
?>
<h3>Edit User</h3>
<form method="POST">
    Username: <input type="text" name="username" value="<?=$d['username']?>"><br><br>
    Nama: <input type="text" name="nama" value="<?=$d['nama']?>"><br><br>
    Level: <select name="level">
        <option value="1" <?=($d['level']==1)?'selected':''?>>Owner</option>
        <option value="2" <?=($d['level']==2)?'selected':''?>>Kasir</option>
    </select><br><br>
    <button type="submit" name="update">Update</button>
</form>