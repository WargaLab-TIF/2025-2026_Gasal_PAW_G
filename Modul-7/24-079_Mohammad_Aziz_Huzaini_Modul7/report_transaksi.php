<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Penjualan</title>
    <style>
        h2 { 
            margin-bottom: 15px; 
            background: #1b66deff;
            color: white;
            padding-left:10px;
        }
        label { display: block; margin: 10px 0 5px; }
        input { padding: 5px; margin-bottom: 10px; }
        button, .btn { padding: 8px 16px; margin: 10px 5px 0 0; }
        .navbar {
            display: flex;
            justify-content: space-between; 
            align-items: center;            
            padding: 10px;
            background: #000000ff;
            color: white;
        }
        .kiri a, .kanan a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="kiri" style="align-left">
            <a href="#">Penjualan</a>
        </div>
        <div class="kanan" style="align-right">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="#">Transaksi</a>
        </div>
    </div>

    <h2>Rekap Laporan Penjualan</h2>
    
    <form method="POST" action="hasil_laporan.php">
        <a href="data_master_transaksi.php" class="btn"> < Kembali</a>

        <label>Tanggal Mulai: <input type="date" name="tanggal_mulai" required> </label>
        <label>Tanggal Akhir: <input type="date" name="tanggal_akhir" required> </label>
        
        <button type="submit">Tampilkan</button>
    </form>
</body>
</html>  