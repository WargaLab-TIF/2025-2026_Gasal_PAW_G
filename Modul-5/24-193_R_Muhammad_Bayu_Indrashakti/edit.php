<?php
include "koneksi.php";

$id = $_GET['id'];
$errors = [];

$data = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
if (mysqli_num_rows($data) == 0) {
    header("Location: index.php");
    exit;
}
$row = mysqli_fetch_assoc($data);

$nama = $row['nama'];
$telp = $row['telp'];
$alamat = $row['alamat'];

if (isset($_POST['update'])) {
    $nama = trim($_POST['nama']);
    $telp = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    // Validasi nama
    if ($nama == "") {
        $errors['nama'] = "Nama tidak boleh kosong.";
    } elseif (!preg_match('/^[A-Za-z\s]+$/', $nama)) {
        $errors['nama'] = "Nama hanya boleh huruf.";
    }

    // Validasi telp
    if ($telp == "") {
        $errors['telp'] = "Telp tidak boleh kosong.";
    } elseif (!preg_match('/^[0-9]+$/', $telp)) {
        $errors['telp'] = "Telp hanya boleh angka.";
    }

    // Validasi alamat
    if ($alamat == "") {
        $errors['alamat'] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match('/[A-Za-z]/', $alamat) || !preg_match('/[0-9]/', $alamat)) {
        $errors['alamat'] = "Alamat harus mengandung huruf dan angka.";
    }

    // Jika semua valid
    if (empty($errors)) {
        $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Data Master Supplier</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="title">Edit Data Master Supplier</div>

    <form method="post">
      <div class="form-row">
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Nama" value="<?= htmlspecialchars($nama) ?>">
      </div>
      <?php if (isset($errors['nama'])): ?><div class="error"><?= $errors['nama'] ?></div><?php endif; ?>

      <div class="form-row">
        <label>Telp</label>
        <input type="text" name="telp" placeholder="Telp" value="<?= htmlspecialchars($telp) ?>">
      </div>
      <?php if (isset($errors['telp'])): ?><div class="error"><?= $errors['telp'] ?></div><?php endif; ?>

      <div class="form-row">
        <label>Alamat</label>
        <textarea name="alamat" placeholder="Alamat"><?= htmlspecialchars($alamat) ?></textarea>
      </div>
      <?php if (isset($errors['alamat'])): ?><div class="error"><?= $errors['alamat'] ?></div><?php endif; ?>

      <button type="submit" name="update" class="btn-save">Update</button>
      <a href="index.php" class="btn-cancel">Batal</a>
    </form>
  </div>
</body>
</html>
