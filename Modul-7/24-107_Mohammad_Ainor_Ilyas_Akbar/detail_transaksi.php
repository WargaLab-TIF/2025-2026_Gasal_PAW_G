<?php
require_once 'config.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data transaksi dengan JOIN ke pelanggan
$query = "SELECT t.*, p.nama_pelanggan, p.email, p.telepon, p.alamat
          FROM transaksi t
          INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
          WHERE t.id_transaksi = $id";
$result = mysqli_query($conn, $query);
$transaksi = mysqli_fetch_assoc($result);

if (!$transaksi) {
    echo "<script>
            alert('Data transaksi tidak ditemukan!');
            window.location.href = 'index.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
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
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .content {
            padding: 40px;
        }
        .detail-section {
            margin-bottom: 30px;
        }
        .detail-section h2 {
            font-size: 1.3em;
            color: #667eea;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
        }
        .detail-value {
            color: #333;
        }
        .detail-value.rupiah {
            color: #27ae60;
            font-weight: bold;
            font-size: 1.2em;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
            background: #d4edda;
            color: #155724;
        }
        .card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-print {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        @media print {
            .button-group {
                display: none;
            }
            body {
                background: white;
                padding: 0;
            }
            .container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👁️ Detail Transaksi</h1>
            <p>Informasi Lengkap Transaksi</p>
        </div>
        <div class="content">
            <!-- Informasi Transaksi -->
            <div class="detail-section">
                <h2>📋 Informasi Transaksi</h2>
                <div class="card">
                    <div class="detail-grid">
                        <div class="detail-label">ID Transaksi:</div>
                        <div class="detail-value">#<?= $transaksi['id_transaksi'] ?></div>
                        
                        <div class="detail-label">Tanggal Transaksi:</div>
                        <div class="detail-value"><?= date('d F Y', strtotime($transaksi['tanggal_transaksi'])) ?></div>
                        
                        <div class="detail-label">Total Pembayaran:</div>
                        <div class="detail-value rupiah">Rp <?= number_format($transaksi['total_pembayaran'], 0, ',', '.') ?></div>
                        
                        <div class="detail-label">Status:</div>
                        <div class="detail-value">
                            <span class="status-badge"><?= ucfirst($transaksi['status']) ?></span>
                        </div>
                        
                        <div class="detail-label">Waktu Input:</div>
                        <div class="detail-value"><?= date('d F Y H:i:s', strtotime($transaksi['created_at'])) ?></div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="detail-section">
                <h2>👤 Informasi Pelanggan</h2>
                <div class="card">
                    <div class="detail-grid">
                        <div class="detail-label">Nama Pelanggan:</div>
                        <div class="detail-value"><?= $transaksi['nama_pelanggan'] ?></div>
                        
                        <div class="detail-label">Email:</div>
                        <div class="detail-value"><?= $transaksi['email'] ?: '-' ?></div>
                        
                        <div class="detail-label">Telepon:</div>
                        <div class="detail-value"><?= $transaksi['telepon'] ?: '-' ?></div>
                        
                        <div class="detail-label">Alamat:</div>
                        <div class="detail-value"><?= $transaksi['alamat'] ?: '-' ?></div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="detail-section">
                <h2>💰 Ringkasan Pembayaran</h2>
                <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <div style="text-align: center;">
                        <p style="font-size: 0.9em; margin-bottom: 10px; opacity: 0.9;">Total yang harus dibayar</p>
                        <p style="font-size: 2.5em; font-weight: bold;">Rp <?= number_format($transaksi['total_pembayaran'], 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>

            <!-- Button Group -->
            <div class="button-group">
                <a href="index.php" class="btn btn-back">← Kembali</a>
                <button onclick="window.print()" class="btn btn-print">🖨️ Cetak</button>
            </div>
        </div>
    </div>
</body>
</html>