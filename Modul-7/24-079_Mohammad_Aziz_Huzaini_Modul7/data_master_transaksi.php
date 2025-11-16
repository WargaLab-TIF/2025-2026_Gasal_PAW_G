<?php

session_start();
include 'koneksi.php';

$query = "SELECT 
            t.id, 
            t.waktu_transaksi, 
            t.keterangan, 
            t.total, 
            p.nama AS nama_pelanggan
          FROM transaksi t
          LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
          ORDER BY t.waktu_transaksi DESC";

$result = mysqli_query($conn, $query);
$transaksi_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Transaksi</title>
    <style>
        h2 { 
            margin-bottom: 15px; 
            background: #1b66deff;
            color: white;
            padding-left:10px;
        }

        .btn-wrapper {
            width: 100%;
            text-align: right;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            margin-left: 10px;
            color: white;
        }

        .btn-laporan { background-color: #2196F3; }
        .btn-tambah { background-color: #4CAF50; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background: #e8e8e8;
            text-align: center;
            font-weight: bold;
        }
        td { text-align: center; }

        a.action {
            color: #2196F3;
            text-decoration: none;
            font-weight: bold;
            margin: 0 5px;
        }
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

<h2>Data Master Transaksi</h2>

<div class="btn-wrapper">
    <button onclick="location.href='report_transaksi.php'" class="btn btn-laporan">
        Lihat Laporan Penjualan
    </button>

    <button onclick="location.href='tambah_transaksi.php'" class="btn btn-tambah">
        Tambah Transaksi
    </button>
</div>

<table>
    <thead>
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

        <?php
        if (count($transaksi_data) > 0) {
            $no = 1;
            foreach ($transaksi_data as $transaksi) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$transaksi['id']}</td>";
                echo "<td>{$transaksi['waktu_transaksi']}</td>";
                echo "<td>{$transaksi['nama_pelanggan']}</td>";
                echo "<td>{$transaksi['keterangan']}</td>";
                echo "<td>Rp " . number_format($transaksi['total'], 0, ',', '.') . "</td>";
                echo "<td>
                        <a class='action' href='#'>Lihat Detail</a> | 
                        <a class='action' href='#'>Hapus</a>
                     </td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data transaksi</td></tr>";
        }
        ?>

    </tbody>
</table>

</body>
</html>   