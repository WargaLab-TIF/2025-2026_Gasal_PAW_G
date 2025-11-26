<?php
require_once "session.php";
deny_if_not_logged_in();
require_level(1);
require_once "conn.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner</title>
    <style>
        .main-content {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 30px;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .dashboard-header h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .dashboard-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
            font-weight: 600;
        }

        .card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .card-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
<?php include "navbar.php"; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h2>Dashboard Owner</h2>
        <p>Selamat datang di panel kontrol sistem penjualan</p>
    </div>

    <div class="card-grid">
        <div class="card">
            <span class="card-icon">📊</span>
            <h3>Data Master</h3>
            <p>Kelola data barang, supplier, pelanggan, dan user</p>
            <a href="data_master.php" class="btn">Akses Data Master</a>
        </div>

        <div class="card">
            <span class="card-icon">💰</span>
            <h3>Transaksi</h3>
            <p>Buat dan kelola transaksi penjualan</p>
            <a href="crud_transaksi/transaksi.php" class="btn">Kelola Transaksi</a>
        </div>

        <div class="card">
            <span class="card-icon">📈</span>
            <h3>Laporan</h3>
            <p>Lihat laporan penjualan dan statistik</p>
            <a href="report_transaksi.php" class="btn">Lihat Laporan</a>
        </div>
    </div>
</div>

</body>
</html>