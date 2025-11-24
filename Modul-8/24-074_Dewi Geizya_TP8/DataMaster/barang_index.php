<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    echo "Anda tidak memiliki akses ke halaman ini!";
    exit;
}

$stmt = $pdo->query("SELECT * FROM barang ORDER BY id ASC");
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 20px; }
        h2 { color: #333; }
        .btn-back { display: inline-block; padding: 8px 14px; background: #0275d8; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
        .btn-back:hover { background: #025aa5; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th { background: #0275d8; color: white; padding: 12px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #e5e5e5; }
        tr:hover { background: #f1f7ff; }
        .btn { padding: 6px 10px; font-size: 13px; text-decoration: none; color: white; border-radius: 4px; }
        .tambah { background: #5cb85c; }
        .edit { background: #f0ad4e; }
        .delete { background: #d9534f; }
    </style>
</head>
<body>

<h2>Data Barang</h2>
<a href="data_master.php" class="btn-back">← Kembali ke Data Master</a>
<a href="barang_tambah.php" class="btn tambah">Tambah Data</a>

<table>
    <tr>
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($barang as $b): ?>
    <tr>
        <td><?= htmlspecialchars($b['id']) ?></td>
        <td><?= htmlspecialchars($b['kode_barang']) ?></td>
        <td><?= htmlspecialchars($b['nama_barang']) ?></td>
        <td><?= number_format($b['harga'], 0, ',', '.') ?></td>
        <td><?= htmlspecialchars($b['stok']) ?></td>
        <td>
            <a href="barang_edit.php?id=<?= $b['id'] ?>" class="btn edit">Edit</a>
            <a href="barang_hapus.php?id=<?= $b['id'] ?>" class="btn delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>