<?php
require_once 'config/config.php';

$stmt = $pdo->query("SELECT * FROM transaksi ORDER BY waktu_transaksi DESC, id DESC");
$transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .header-app {
            background-color: #007bff;
            color: white;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .page-title {
            background-color: #007bff;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-action-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-view-report {
            background-color: #007bff;
            color: white;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
        }
        .btn-detail {
            background-color: #007bff;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header-app">
        <div class="container">
            <h2 class="mb-0">Penjualan</h2>
        </div>
    </div>

    <div class="container">
        <div class="page-title d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Master Transaksi</h3>
            <div class="btn-action-group">
                <a href="report_transaksi.php" class="btn btn-view-report">
                    <i class="bi bi-graph-up"></i> Lihat Laporan Penjualan
                </a>
                <a href="#" class="btn btn-add">
                    <i class="bi bi-plus-circle"></i> Tambah Transaksi
                </a>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transaksi)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data transaksi</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($transaksi as $index => $t): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $t['id'] ?></td>
                                <td><?= date('Y-m-d', strtotime($t['waktu_transaksi'])) ?></td>
                                <td><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                                <td><?= htmlspecialchars($t['keterangan']) ?></td>
                                <td>Rp<?= number_format($t['total'], 0, ',', '.') ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-detail">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                    <a href="#" class="btn btn-sm btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

