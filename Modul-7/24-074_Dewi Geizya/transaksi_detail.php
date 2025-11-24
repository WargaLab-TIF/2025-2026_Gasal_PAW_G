<?php
require __DIR__ . '/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: transaksi.php');
    exit;
}


$sqlT = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
          FROM transaksi t
          LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
          WHERE t.id = ?";
$stmtT = mysqli_prepare($conn, $sqlT);
mysqli_stmt_bind_param($stmtT, 'i', $id);
mysqli_stmt_execute($stmtT);
$resT = mysqli_stmt_get_result($stmtT);
$transaksi = mysqli_fetch_assoc($resT) ?: null;
mysqli_free_result($resT);
mysqli_stmt_close($stmtT);

if (!$transaksi) {
    header('Location: transaksi.php');
    exit;
}

$sqlD = "SELECT d.id, b.nama_barang, d.harga, d.qty, (d.harga * d.qty) AS subtotal
          FROM transaksi_detail d
          LEFT JOIN barang b ON d.barang_id = b.id
          WHERE d.transaksi_id = ?";
$stmtD = mysqli_prepare($conn, $sqlD);
mysqli_stmt_bind_param($stmtD, 'i', $id);
mysqli_stmt_execute($stmtD);
$resD = mysqli_stmt_get_result($stmtD);
$detail = [];
while ($row = mysqli_fetch_assoc($resD)) {
    $detail[] = $row;
}
mysqli_free_result($resD);
mysqli_stmt_close($stmtD);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
    <a href="transaksi.php">Penjualan XYZ</a>
    <a href="#" style="opacity:.7">Supplier</a>
    <a href="#" style="opacity:.7">Barang</a>
    <a href="transaksi.php" style="text-decoration:underline">Transaksi</a>
    <span style="margin-left:auto;opacity:.8">Detail Transaksi</span>
</div>

<div class="wrap">
    <h2>Detail Transaksi</h2>

    <div class="header-bar">Data Transaksi</div>
    <table class="table">
        <tr>
            <th style="width:150px;">ID Transaksi</th>
            <td><?php echo htmlspecialchars($transaksi['id']); ?></td>
        </tr>
        <tr>
            <th>Waktu Transaksi</th>
            <td><?php echo htmlspecialchars($transaksi['waktu_transaksi']); ?></td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <td><?php echo htmlspecialchars($transaksi['nama_pelanggan'] ?? '-'); ?></td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td><?php echo htmlspecialchars($transaksi['keterangan']); ?></td>
        </tr>
        <tr>
            <th>Total</th>
            <td>Rp<?php echo number_format((int)$transaksi['total'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <h3 style="margin-top:16px;">Rincian Barang</h3>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th class="right">Harga</th>
            <th class="right">Qty</th>
            <th class="right">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($detail)): ?>
            <tr><td colspan="5" style="text-align:center;color:#6b7280;">Tidak ada detail barang</td></tr>
        <?php else: ?>
            <?php $no=1; foreach ($detail as $d): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($d['nama_barang']); ?></td>
                    <td class="right">Rp<?php echo number_format((int)$d['harga'], 0, ',', '.'); ?></td>
                    <td class="right"><?php echo (int)$d['qty']; ?></td>
                    <td class="right">Rp<?php echo number_format((int)$d['subtotal'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top:12px;">
        <a href="transaksi.php" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>
</html>
