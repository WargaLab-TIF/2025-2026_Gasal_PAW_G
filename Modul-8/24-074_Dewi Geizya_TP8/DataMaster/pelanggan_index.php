<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM pelanggan ORDER BY id ASC");
$pelanggan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 20px; }
        h2 { color: #333; }
        .btn-back { display: inline-block; padding: 8px 14px; background: #0275d8; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px; }
        .btn-back:hover { background: #025aa5; }
        .tambah { background: #5cb85c; }
        .tambah:hover { background: #449d44; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-top: 15px; }
        th { background: #0275d8; color: white; padding: 12px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #e5e5e5; }
        tr:hover { background: #f1f7ff; }
        .btn { padding: 6px 10px; font-size: 13px; text-decoration: none; color: white; border-radius: 4px; }
        .edit { background: #f0ad4e; }
        .delete { background: #d9534f; }
    </style>
</head>
<body>

<h2>Data Pelanggan</h2>
<a href="data_master.php" class="btn-back">← Kembali ke Data Master</a>
<a href="pelanggan_tambah.php" class="btn tambah">Tambah Data</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($pelanggan as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['nama']) ?></td>
        <td><?= ($p['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
        <td><?= htmlspecialchars($p['telp']) ?></td>
        <td><?= htmlspecialchars($p['alamat']) ?></td>
        <td>
            <a href="pelanggan_edit.php?id=<?= $p['id'] ?>" class="btn edit">Edit</a>
            <a href="pelanggan_hapus.php?id=<?= $p['id'] ?>" class="btn delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>