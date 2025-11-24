<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$id = $_GET['id'] ?? '';
$q = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id'");
$p = mysqli_fetch_assoc($q);

if (!$p) {
    echo "<div class='container'>Data pelanggan tidak ditemukan.</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    mysqli_query($conn, "UPDATE pelanggan SET 
                         nama='$nama',
                         jenis_kelamin='$jk',
                         telp='$telp',
                         alamat='$alamat'
                         WHERE id='$id'");

    header("Location: pelanggan.php");
    exit;
}
?>

<div class="container" style="max-width:700px">
  <h2>Edit Pelanggan</h2>

  <form method="POST">

    <div class="form-row">
      <label>Nama</label>
      <input type="text" name="nama" value="<?= htmlspecialchars($p['nama']) ?>" required>
    </div>

    <div class="form-row">
      <label>Jenis Kelamin</label>
      <select name="jenis_kelamin" required>
        <option value="L" <?= $p['jenis_kelamin']=="L" ? "selected":"" ?>>Laki-laki</option>
        <option value="P" <?= $p['jenis_kelamin']=="P" ? "selected":"" ?>>Perempuan</option>
      </select>
    </div>

    <div class="form-row">
      <label>Telepon</label>
      <input type="text" name="telp" value="<?= htmlspecialchars($p['telp']) ?>">
    </div>

    <div class="form-row">
      <label>Alamat</label>
      <textarea name="alamat"><?= htmlspecialchars($p['alamat']) ?></textarea>
    </div>

    <button class="btn">Update</button>
    <a class="btn btn-secondary" href="pelanggan.php">Batal</a>

  </form>
</div>
