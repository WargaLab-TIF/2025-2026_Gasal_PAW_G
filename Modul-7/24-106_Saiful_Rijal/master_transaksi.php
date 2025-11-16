<?php
include 'koneksi.php';

$sql = "SELECT * FROM transaksi ORDER BY id ASC";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            padding: 5px 10px;
        }

        .navbar .nav-links a.active {
            background-color: #555;
            border-radius: 5px;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .toolbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f8f9fa;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td .btn {
            padding: 5px 10px;
            font-size: 12px;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">Penjualan <span style="color: #007bff">xyz</span></div>
        <div class="nav-links">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="master_transaksi.php" class="active">Transaksi</a>
        </div>
    </nav>

    <div class="container">
        <h2>Data Master Transaksi</h2>

        <div class="toolbar">
            <a href="report_transaksi.php" class="btn btn-primary" style="margin-right: 15px;">Lihat Laporan Penjualan</a>
            <a href="tambah_transaksi.php" class="btn btn-success" style="margin-right: 15px;">Tambah Transaksi</a>
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
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $pelanggan_id = $row['pelanggan_id'];
                        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id = '$pelanggan_id'");
                        $pelanggan = mysqli_fetch_assoc($query);
                        $nama_pelanggan = $pelanggan['nama'];
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['waktu_transaksi'])); ?></td>
                            <td><?php echo $nama_pelanggan; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td>Rp<?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="detail_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Lihat Detail</a>
                                <a href="hapus_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data transaksi</td></tr>";
                }
                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>