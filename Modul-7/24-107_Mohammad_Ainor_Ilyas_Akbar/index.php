<?php
require_once 'config.php';

// Query untuk mengambil data transaksi dengan JOIN
$query = "SELECT t.id_transaksi, t.tanggal_transaksi, p.nama_pelanggan, 
          t.total_pembayaran, t.status
          FROM transaksi t
          INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
          ORDER BY t.tanggal_transaksi DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .button-group {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .btn-report {
            display: inline-block;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.4);
        }
        .btn-report:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.6);
        }
        .btn-add {
            display: inline-block;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(56, 239, 125, 0.4);
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 239, 125, 0.6);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:hover {
            background: #f5f5f5;
        }
        .rupiah {
            color: #27ae60;
            font-weight: bold;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        .btn-detail {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: bold;
            transition: transform 0.2s;
            display: inline-block;
        }
        .btn-detail:hover {
            transform: scale(1.05);
        }
        .btn-delete {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: bold;
            transition: transform 0.2s;
            display: inline-block;
        }
        .btn-delete:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Data Master Transaksi</h1>
            <p>Sistem Informasi Penjualan</p>
        </div>
        <div class="content">
            <div class="button-group">
                <a href="report_transaksi.php" class="btn-report">📈 Lihat Laporan Penjualan</a>
                <a href="tambah_transaksi.php" class="btn-add">➕ Tambah transaksi</a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Pembayaran</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['id_transaksi'] ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal_transaksi'])) ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td class="rupiah">Rp <?= number_format($row['total_pembayaran'], 0, ',', '.') ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="detail_transaksi.php?id=<?= $row['id_transaksi'] ?>" class="btn-detail">👁️ Detail</a>
                                <a href="hapus_transaksi.php?id=<?= $row['id_transaksi'] ?>" 
                                   class="btn-delete" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>