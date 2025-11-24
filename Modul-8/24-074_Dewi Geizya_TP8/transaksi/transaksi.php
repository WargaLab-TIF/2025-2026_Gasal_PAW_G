<?php
include '../auth.php';
require '../koneksi.php';

// ambil semua transaksi + nama pelanggan
$sql = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        ORDER BY t.waktu_transaksi ASC";

$result = mysqli_query($conn, $sql);
$transaksi = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $transaksi[] = $row;
    }
    mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
    <a href="transaksi.php">Penjualan XYZ</a>
    <a href="#" style="opacity:.7">Supplier</a>
    <a href="#" style="opacity:.7">Barang</a>
    <a href="transaksi.php" style="text-decoration:underline">Transaksi</a>
    <span style="margin-left:auto;opacity:.8">Data Master Transaksi</span>
</div>

<div class="wrap">
    <div style="display:flex;justify-content:space-between;align-items:center">
        <h2>Data Master Transaksi</h2>
        <div>
            <a href="report_transaksi.php" class="btn btn-primary">Laporan</a>
            <a href="transaksi_tambah.php" class="btn btn-success">Tambah</a>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th class="right">Total</th>
            <th>Tindakan</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($transaksi)): ?>
            <tr>
                <td colspan="7" style="text-align:center;color:#6b7280;">Belum ada data transaksi</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($transaksi as $t): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($t['id']); ?></td>
                    <td><?php echo htmlspecialchars($t['waktu_transaksi']); ?></td>
                    <td><?php echo htmlspecialchars($t['nama_pelanggan'] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($t['keterangan']); ?></td>
                    <td class="right">Rp<?php echo number_format((int)$t['total'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="transaksi_detail.php?id=<?php echo $t['id']; ?>" class="btn btn-secondary">Detail</a>
                        <a href="transaksi_hapus.php?id=<?php echo $t['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus transaksi ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
