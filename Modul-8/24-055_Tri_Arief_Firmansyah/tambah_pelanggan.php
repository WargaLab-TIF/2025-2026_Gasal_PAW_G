<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    // ID pelanggan di DB Anda berupa string random → saya beri contoh generate unik sederhana.
    $id = uniqid();

    mysqli_query($conn, "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat)
                         VALUES ('$id', '$nama', '$jk', '$telp', '$alamat')");

    header("Location: pelanggan.php");
    exit;
}
?>

<div class="container" style="max-width:700px">
  <h2>Tambah Pelanggan</h2>

  <form method="POST">
    <div class="form-row">
      <label>Nama</label>
      <input type="text" name="nama" required>
    </div>

    <div class="form-row">
      <label>Jenis Kelamin</label>
      <select name="jenis_kelamin" required>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
      </select>
    </div>

    <div class="form-row">
      <label>Telepon</label>
      <input type="text" name="telp">
    </div>

    <div class="form-row">
      <label>Alamat</label>
      <textarea name="alamat"></textarea>
    </div>

    <button class="btn">Simpan</button>
    <a class="btn btn-secondary" href="pelanggan.php">Batal</a>
  </form>
</div>
