<?php
require 'db.php';

// Handle create/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $harga = intval($_POST['harga'] ?? 0);
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare('UPDATE barang SET nama=?, harga_satuan=? WHERE id=?');
        $stmt->execute([$nama, $harga, $id]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO barang (nama, harga_satuan) VALUES (?, ?)');
        $stmt->execute([$nama, $harga]);
    }
    header('Location: barang.php');
    exit;
}

// Handle delete via GET (confirmation done via JS)
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    // Check if referenced in transaksi_detail
    $stmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM transaksi_detail WHERE barang_id = ?');
    $stmt->execute([$delete_id]);
    $row = $stmt->fetch();
    if ($row && $row['cnt'] > 0) {
        $error = 'Barang tidak dapat dihapus karena sudah digunakan dalam transaksi.';
    } else {
        $stmt = $pdo->prepare('DELETE FROM barang WHERE id = ?');
        $stmt->execute([$delete_id]);
        header('Location: barang.php');
        exit;
    }
}

$barang = $pdo->query('SELECT * FROM barang ORDER BY id DESC')->fetchAll();
?>
<!doctype html>
<html><head>
<title>Kelola Barang</title>
<link rel="stylesheet" href="assets/style.css">
<script>
function confirmDelete(id){
  if(confirm('Yakin ingin menghapus barang ini?')) {
    window.location.href='barang.php?delete=' + encodeURIComponent(id);
  }
}
</script>
</head>
<body>
<div class="container">
  <h1>Kelola Barang</h1>
  <?php if (!empty($error)): ?><p class="error"><?=htmlspecialchars($error)?></p><?php endif; ?>

  <h2>Tambah / Edit Barang</h2>
  <form method="post">
    <input type="hidden" name="id" value="">
    <div class="form-row"><label>Nama</label><input name="nama" required></div>
    <div class="form-row"><label>Harga Satuan (angka)</label><input name="harga" type="number" required></div>
    <button type="submit" class="button">Simpan</button>
  </form>

  <h2>Daftar Barang</h2>
  <table>
    <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
    <?php foreach($barang as $b): ?>
    <tr>
      <td><?=htmlspecialchars($b['id'])?></td>
      <td><?=htmlspecialchars($b['nama'])?></td>
      <td><?=number_format($b['harga_satuan'])?></td>
      <td>
        <!-- Simple edit by populating form (JS could be added to prefill) -->
        <a class="button" href="barang_edit.php?id=<?=urlencode($b['id'])?>">Edit</a>
        <a class="button" href="javascript:void(0)" onclick="confirmDelete(<?=json_encode($b['id'])?>)">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  <p><a href="index.php">Kembali ke Dashboard</a></p>
</div>
</body></html>
