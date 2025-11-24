<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";
if($_SESSION['level'] != 1){ echo "<div class='container'>Anda tidak punya akses</div>"; exit; }

$id = intval($_GET['id'] ?? 0);
$q = mysqli_query($conn, "SELECT * FROM user WHERE id_user=$id");
$r = mysqli_fetch_assoc($q);
if(!$r){ echo "<div class='container'>User tidak ditemukan</div>"; exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $level = intval($_POST['level']);
    mysqli_query($conn, "UPDATE user SET username='$username', password='$password', nama='$nama', alamat='$alamat', hp='$hp', level=$level WHERE id_user=$id");
    header("Location: user.php"); exit;
}
?>
<div class="container" style="max-width:700px">
  <h2>Edit User</h2>
  <form method="post">
    <div class="form-row"><label>Username</label><input name="username" value="<?=htmlspecialchars($r['username'])?>" required></div>
    <div class="form-row"><label>Password</label><input name="password" value="<?=htmlspecialchars($r['password'])?>" required></div>
    <div class="form-row"><label>Nama</label><input name="nama" value="<?=htmlspecialchars($r['nama'])?>" required></div>
    <div class="form-row"><label>Alamat</label><textarea name="alamat"><?=htmlspecialchars($r['alamat'])?></textarea></div>
    <div class="form-row"><label>HP</label><input name="hp" value="<?=htmlspecialchars($r['hp'])?>"></div>
    <div class="form-row"><label>Level (1=owner,2=kasir)</label><input name="level" type="number" min="1" max="2" value="<?= $r['level'] ?>"></div>
    <button class="btn">Update</button>
    <a class="btn btn-secondary" href="user.php">Batal</a>
  </form>
</div>
