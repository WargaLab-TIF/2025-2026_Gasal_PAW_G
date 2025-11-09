<?php
require_once 'config.php';

$conn = getConnection();

$barang_query = "SELECT b.*, s.nama as nama_supplier FROM barang b 
                 LEFT JOIN supplier s ON b.supplier_id = s.id 
                 ORDER BY b.id";
$barang_result = $conn->query($barang_query);

$transaksi_query = "SELECT t.*, p.nama as nama_pelanggan FROM transaksi t 
                    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id 
                    ORDER BY t.waktu_transaksi DESC";
$transaksi_result = $conn->query($transaksi_query);

$detail_query = "SELECT td.*, b.kode_barang, b.nama_barang, b.harga_satuan, t.waktu_transaksi 
                 FROM transaksi_detail td 
                 JOIN barang b ON td.barang_id = b.id 
                 JOIN transaksi t ON td.transaksi_id = t.id 
                 ORDER BY td.id DESC";
$detail_result = $conn->query($detail_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Master Detail Data</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #333;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            color: #333;
            background: white;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }
        
        .btn-success {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }
        
        .btn:hover {
            opacity: 0.8;
        }
        
        .section {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .section h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        th {
            background: #f8f9fa;
            font-weight: bold;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pengelolaan Master Detail Data</h1>
        </div>
        
        <div class="action-buttons">
            <a href="tambah_transaksi.php" class="btn btn-primary">Tambah Transaksi</a>
            <a href="tambah_detail_transaksi.php" class="btn btn-success">Tambah Detail Transaksi</a>
        </div>
        
        <div class="section">
            <h2>Data Barang</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Nama Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($barang_result && $barang_result->num_rows > 0) {
                        while ($row = $barang_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['kode_barang']}</td>";
                            echo "<td>{$row['nama_barang']}</td>";
                            echo "<td>Rp " . number_format($row['harga_satuan'], 0, ',', '.') . "</td>";
                            echo "<td>{$row['stok']}</td>";
                            echo "<td>" . ($row['nama_supplier'] ?? '-') . "</td>";
                            echo "<td><a href='hapus_barang.php?id={$row['id']}' class='btn-delete'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data barang</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <h2>Data Transaksi</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Waktu Transaksi</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Pelanggan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($transaksi_result && $transaksi_result->num_rows > 0) {
                        while ($row = $transaksi_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>" . date('d/m/Y H:i:s', strtotime($row['waktu_transaksi'])) . "</td>";
                            echo "<td>{$row['keterangan']}</td>";
                            echo "<td class='text-right'>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
                            echo "<td>" . ($row['nama_pelanggan'] ?? '-') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Tidak ada data transaksi</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <h2>Data Transaksi Detail</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($detail_result && $detail_result->num_rows > 0) {
                        while ($row = $detail_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['transaksi_id']}</td>";
                            echo "<td>" . date('d/m/Y H:i:s', strtotime($row['waktu_transaksi'])) . "</td>";
                            echo "<td>{$row['kode_barang']}</td>";
                            echo "<td>{$row['nama_barang']}</td>";
                            echo "<td class='text-right'>Rp " . number_format($row['harga_satuan'], 0, ',', '.') . "</td>";
                            echo "<td class='text-center'>{$row['qty']}</td>";
                            echo "<td class='text-right'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Tidak ada data transaksi detail</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

