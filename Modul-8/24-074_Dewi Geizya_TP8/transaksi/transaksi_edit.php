<?php
include '../auth.php';
require '../koneksi.php';

$q = $pdo->query("SELECT t.id, t.waktu_transaksi, t.total, p.nama AS nama_pelanggan
                  FROM transaksi t
                  LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
                  ORDER BY t.waktu_transaksi DESC");
$transaksi = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 20px; }
        h2 { color: #333; }
        .btn-back { display: inline-block; padding: 8px 14px; background: #0275d8; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
        .btn-back:hover { background: #025aa5; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        th { background: #0275d8; color: white; padding: 12px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #e5e5e5; }
        tr:hover { background: #f1f7ff; }
        .btn { padding: 6px 10px; font-size: 13px; text-decoration: none; color: white; border-radius: 4px; }
        .tambah { background: #5cb85c; }
        .detail { background: #007bff; }
        .delete { background: #d9534f; }
    </style>
</head>
<body>

<h2>Daftar Transaksi</h2>
<a href="../home.php" class="btn-back">← Kembali ke Home</a>
<a href="transaksi_tambah.php" class="btn tambah">Tambah Transaksi Baru</a>

<table>
    <tr>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($transaksi as $t): ?>
    <tr>
        <td><?= htmlspecialchars($t['id']) ?></td>
        <td><?= date('d-m-Y H:i', strtotime($t['waktu_transaksi'])) ?></td>
        <td><?= htmlspecialchars($t['nama_pelanggan'] ?? '-') ?></td>
        <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
        <td>
            <a href="transaksi_detail.php?id=<?= $t['id'] ?>" class="btn detail">Detail</a>
            <?php if ($_SESSION['user']['level'] == 1): ?>
                <a href="transaksi_hapus.php?id=<?= $t['id'] ?>" class="btn delete" onclick="return confirm('Yakin hapus transaksi ini?')">Hapus</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>