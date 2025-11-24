<?php
include 'koneksi.php';

$result = $conn->query("
    SELECT id, tanggal, nama_pelanggan, keterangan, total
    FROM transaksi1 
    ORDER BY tanggal DESC, id ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Master Transaksi</title>
<style>
    body { font-family: Arial; background: #f0f2f5; margin:0; padding:0; }

    .navbar {
        background: #333;
        padding: 12px 25px;
        color: white;
        font-size: 20px;
        font-weight: bold;
    }

    .container {
        width: 95%;
        margin: 20px auto;
    }

    .header-box {
        background: #1e88e5;
        padding: 12px;
        color: white;
        font-size: 18px;
        font-weight: bold;
        border-radius: 6px 6px 0 0;
    }

    .top-buttons {
        display: flex;
        justify-content: flex-end;
        background: white;
        padding: 10px;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        color: white;
        margin-left: 10px;
    }

    .btn-blue { background: #007bff; }
    .btn-green { background: #28a745; }
    .btn-detail { background: #17a2b8; }
    .btn-red { background: #dc3545; }

    table {
        width:100%;
        border-collapse: collapse;
        background: white;
        border:1px solid #ccc;
    }

    th {
        background: #e3f2fd;
        padding: 10px;
        border:1px solid #ccc;
    }

    td {
        padding: 10px;
        border:1px solid #ccc;
        text-align: center;
    }
</style>
</head>
<body>

<div class="navbar">Penjualan XYZ</div>

<div class="container">

    <div class="header-box">Data Master Transaksi</div>

    <div class="top-buttons">
        <a href="report_transaksi.php" class="btn btn-green">Lihat Laporan Penjualan</a>
        <a href="tambah_transaksi.php" class="btn btn-green">Tambah Transaksi</a>
        <a href="index.php" class="btn btn-green">lihat grafik</a>

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
            $no = 1;
            // Pengecekan: Pastikan $result adalah objek yang valid sebelum diulang
            if ($result) {
                while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td>Rp<?= number_format($row['total'],0,',','.') ?></td>
                    <td>
                        <a href="detail_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-detail">Lihat Detail</a>
                        <a href="hapus_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-red" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                    </td>
                </tr>
                <?php }
            } else {
                // Tampilkan pesan kesalahan SQL jika kueri gagal
                echo "<tr><td colspan='7' style='text-align: left; color: red;'>Error dalam kueri SQL: " . $conn->error . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

</div>

</body>
</html>
