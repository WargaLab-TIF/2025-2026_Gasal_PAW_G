<?php
// pelanggan.php - CRUD simple untuk tabel pelanggan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

$errors = [];
$success = '';

// HANDLE CREATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $nama = trim($_POST['nama'] ?? '');
    if ($nama === '') {
        $errors[] = 'Nama pelanggan tidak boleh kosong.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO pelanggan (nama) VALUES (?)');
            $stmt->execute([$nama]);
            $success = 'Pelanggan berhasil ditambahkan.';
            // clear form value
            $_POST = [];
        } catch (PDOException $e) {
            $errors[] = 'Gagal menyimpan: ' . $e->getMessage();
        }
    }
}

// HANDLE UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = intval($_POST['id'] ?? 0);
    $nama = trim($_POST['nama'] ?? '');
    if ($id <= 0) $errors[] = 'ID tidak valid.';
    if ($nama === '') $errors[] = 'Nama tidak boleh kosong.';
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('UPDATE pelanggan SET nama = ? WHERE id = ?');
            $stmt->execute([$nama, $id]);
            $success = 'Pelanggan berhasil diupdate.';
            header('Location: pelanggan.php');
            exit;
        } catch (PDOException $e) {
            $errors[] = 'Gagal update: ' . $e->getMessage();
        }
    }
}

// HANDLE DELETE via GET param
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    if ($del_id > 0) {
        try {
            $stmt = $pdo->prepare('DELETE FROM pelanggan WHERE id = ?');
            $stmt->execute([$del_id]);
            header('Location: pelanggan.php');
            exit;
        } catch (PDOException $e) {
            $errors[] = 'Gagal hapus: ' . $e->getMessage();
        }
    }
}

// fetch all pelanggan
$pelanggan = $pdo->query('SELECT * FROM pelanggan ORDER BY id DESC')->fetchAll();

// if editing, fetch the item
$edit_item = null;
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    if ($eid > 0) {
        $stmt = $pdo->prepare('SELECT * FROM pelanggan WHERE id = ?');
        $stmt->execute([$eid]);
        $edit_item = $stmt->fetch();
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Kelola Pelanggan</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
  <h1>Pelanggan</h1>

  <?php if ($errors): foreach($errors as $e): ?>
    <small class="error"><?=htmlspecialchars($e)?></small>
  <?php endforeach; endif; ?>

  <?php if ($success): ?>
    <p style="color:green;"><?=htmlspecialchars($success)?></p>
  <?php endif; ?>

  <h2><?= $edit_item ? 'Edit Pelanggan' : 'Tambah Pelanggan' ?></h2>
  <form method="post" action="pelanggan.php">
    <input type="hidden" name="action" value="<?= $edit_item ? 'update' : 'create' ?>">
    <?php if ($edit_item): ?>
      <input type="hidden" name="id" value="<?=htmlspecialchars($edit_item['id'])?>">
    <?php endif; ?>
    <div class="form-row">
      <label>Nama</label>
      <input name="nama" value="<?=htmlspecialchars($_POST['nama'] ?? ($edit_item['nama'] ?? ''))?>" required>
    </div>
    <button class="button" type="submit"><?= $edit_item ? 'Simpan Perubahan' : 'Tambah' ?></button>
    <?php if ($edit_item): ?><a href="pelanggan.php" class="button">Batal</a><?php endif; ?>
  </form>

  <h2>Daftar Pelanggan</h2>
  <table>
    <tr><th>ID</th><th>Nama</th><th>Aksi</th></tr>
    <?php foreach($pelanggan as $p): ?>
      <tr>
        <td><?=htmlspecialchars($p['id'])?></td>
        <td><?=htmlspecialchars($p['nama'])?></td>
        <td>
          <a class="button" href="pelanggan.php?edit=<?=urlencode($p['id'])?>">Edit</a>
          <a class="button" href="javascript:void(0)" onclick="if(confirm('Yakin hapus?')){window.location='pelanggan.php?delete=<?=urlencode($p['id'])?>'}">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <p><a href="index.php">Kembali ke Dashboard</a></p>
</div>
</body>
</html>
