<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas 6 PAW - Master Detail</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #212529;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            overflow: hidden;
        }
        .card-header {
            padding: 16px 24px;
            background-color: #f0f3f5;
            border-bottom: 1px solid #dee2e6;
        }
        .card-header h1, .card-header h2 {
            margin: 0;
            color: #004085;
        }
        .card-body {
            padding: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:nth-child(even) {
            background-color: #fdfdfd;
        }
        .navigasi {
            margin-bottom: 20px;
        }
        .action-link {
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.2s ease-in-out;
        }
        .link-tambah {
            background-color: #007bff;
            color: white;
            margin-right: 10px;
        }
        .link-tambah:hover {
            background-color: #0056b3;
        }
        .link-hapus {
            background-color: #dc3545;
            color: white;
            font-size: 0.9em;
            padding: 5px 10px;
        }
        .link-hapus:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Pengelolaan Master Detail</h1>
            </div>
            <div class="card-body">
                <div class="navigasi">
                    <a href="tambah_transaksi.php" class="action-link link-tambah">Tambah Transaksi</a>
                    <a href="tambah_detail.php" class="action-link link-tambah">Tambah Transaksi Detail</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Barang</h2>
            </div>
            <div class="card-body" style="padding: 0;">
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
                        $sql_barang = "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama 
                                       FROM barang b LEFT JOIN supplier s ON b.supplier_id = s.id
                                       ORDER BY b.id";
                        $result_barang = $koneksi->query($sql_barang);
                        if ($result_barang->num_rows > 0) {
                            while($row = $result_barang->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['kode_barang']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                                echo "<td>Rp " . number_format($row['harga']) . "</td>";
                                echo "<td>" . $row['stok'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "<td>
                                        <a href='hapus_barang.php?id=" . $row['id'] . "' 
                                           class='action-link link-hapus' 
                                           onclick=\"return confirm('Apakah anda yakin ingin menghapus data ini?');\">
                                           Delete
                                        </a>
                                      </td>"; 
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Tidak ada data barang.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Transaksi</h2>
            </div>
            <div class="card-body" style="padding: 0;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Waktu Transaksi</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Nama Pelanggan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama
                                          FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
                                          ORDER BY t.id";
                        $result_transaksi = $koneksi->query($sql_transaksi);
                        if ($result_transaksi->num_rows > 0) {
                            while($row = $result_transaksi->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['waktu_transaksi'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                echo "<td>Rp " . number_format($row['total']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data transaksi.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Transaksi Detail</h2>
            </div>
            <div class="card-body" style="padding: 0;">
                <table>
                    <thead>
                        <tr>
                            <th>Transaksi ID</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty 
                                       FROM transaksi_detail td JOIN barang b ON td.barang_id = b.id
                                       ORDER BY td.transaksi_id, b.nama_barang";
                        $result_detail = $koneksi->query($sql_detail);
                        if ($result_detail->num_rows > 0) {
                            while($row = $result_detail->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['transaksi_id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                                echo "<td>Rp " . number_format($row['harga']) . "</td>";
                                echo "<td>" . $row['qty'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data detail transaksi.</td></tr>";
                        }
                        $koneksi->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>