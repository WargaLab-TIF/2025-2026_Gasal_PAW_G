<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";
if($_SESSION['level'] != 1){
    echo "<div class='container'>Anda tidak punya akses</div>"; exit;
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $level = intval($_POST['level']);
    mysqli_query($conn, "INSERT INTO user (username,password,nama,alamat,hp,level) VALUES ('$username','$password','$nama','$alamat','$hp',$level)");
    header("Location: user.php"); exit;
}
?>
<div class="container" style="max-width:700px">
  <h2>Tambah User</h2>
  <form method="post">
    <div class="form-row"><label>Username</label><input name="username" required></div>
    <div class="form-row"><label>Password</label><input name="password" required></div>
    <div class="form-row"><label>Nama</label><input name="nama" required></div>
    <div class="form-row"><label>Alamat</label><textarea name="alamat"></textarea></div>
    <div class="form-row"><label>HP</label><input name="hp"></div>
    <div class="form-row"><label>Level (1=owner,2=kasir)</label><input name="level" type="number" min="1" max="2" value="2"></div>
    <button class="btn">Simpan</button>
    <a class="btn btn-secondary" href="user.php">Batal</a>
  </form>
</div>
