<?php
require_once "session.php";
deny_if_not_logged_in();
require_level(1); // hanya owner
include "navbar.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master</title>
    <style>
        .main-content {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 30px;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .page-header h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .menu-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            border: 1px solid #f0f0f0;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            font-size: 52px;
            margin-bottom: 20px;
            display: block;
        }

        .menu-card h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .menu-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .menu-card .arrow {
            display: inline-block;
            margin-top: 15px;
            color: #667eea;
            font-weight: 600;
            font-size: 14px;
        }

        .menu-card:hover .arrow {
            transform: translateX(5px);
            display: inline-block;
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body>

<div class="main-content">
    <div class="page-header">
        <h2>Data Master</h2>
        <p>Kelola semua data master sistem penjualan</p>
    </div>

    <div class="menu-grid">
        <a href="/TP/tp8/crud_barang/data_barang.php" class="menu-card">
            <span class="menu-icon">📦</span>
            <h3>Data Barang</h3>
            <p>Kelola informasi produk, stok, dan harga barang</p>
            <span class="arrow">Lihat Detail →</span>
        </a>

        <a href="/TP/tp8/crud_supplier/data_supplier.php" class="menu-card">
            <span class="menu-icon">🚚</span>
            <h3>Data Supplier</h3>
            <p>Kelola data pemasok dan vendor</p>
            <span class="arrow">Lihat Detail →</span>
        </a>

        <a href="/TP/tp8/crud_pelanggan/data_pelanggan.php" class="menu-card">
            <span class="menu-icon">👥</span>
            <h3>Data Pelanggan</h3>
            <p>Kelola informasi pelanggan dan kontak</p>
            <span class="arrow">Lihat Detail →</span>
        </a>

        <a href="/TP/tp8/crud_user/data_user.php" class="menu-card">
            <span class="menu-icon">👤</span>
            <h3>Data User</h3>
            <p>Kelola pengguna dan hak akses sistem</p>
            <span class="arrow">Lihat Detail →</span>
        </a>
    </div>
</div>

</body>
</html>