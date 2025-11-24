<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$id = intval($_GET['id'] ?? 0);
$q = mysqli_query($conn, "SELECT * FROM supplier WHERE id=$id");
$r = mysqli_fetch_assoc($q);
if(!$r){ echo "<div class='container'>Supplier tidak ditemukan</div>"; exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat', email='$email' WHERE id=$id");
    header("Location: supplier.php");
    exit;
}
?>
<div class="container" style="max-width:700px">
  <h2>Edit Supplier</h2>
  <form method="post">
    <div class="form-row"><label>Nama</label><input name="nama" value="<?=htmlspecialchars($r['nama'])?>" required></div>
    <div class="form-row"><label>Telp</label><input name="telp" value="<?=htmlspecialchars($r['telp'])?>"></div>
    <div class="form-row"><label>Alamat</label><textarea name="alamat"><?=htmlspecialchars($r['alamat'])?></textarea></div>
    <div class="form-row"><label>Email</label><input name="email" value="<?=htmlspecialchars($r['email'])?>"></div>
    <button class="btn">Update</button>
    <a class="btn btn-secondary" href="supplier.php">Batal</a>
  </form>
</div>
