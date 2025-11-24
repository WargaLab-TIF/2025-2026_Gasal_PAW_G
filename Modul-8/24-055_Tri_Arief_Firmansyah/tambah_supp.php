<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat, email) VALUES ('$nama','$telp','$alamat','$email')");
    header("Location: supplier.php");
    exit;
}
?>
<div class="container" style="max-width:700px">
  <h2>Tambah Supplier</h2>
  <form method="post">
    <div class="form-row"><label>Nama</label><input name="nama" required></div>
    <div class="form-row"><label>Telp</label><input name="telp"></div>
    <div class="form-row"><label>Alamat</label><textarea name="alamat"></textarea></div>
    <div class="form-row"><label>Email</label><input name="email" type="text"></div>
    <button class="btn">Simpan</button>
    <a class="btn btn-secondary" href="supplier.php">Batal</a>
  </form>
</div>
