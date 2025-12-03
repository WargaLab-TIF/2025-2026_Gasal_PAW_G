<?php
session_start();
include 'koneksi.php';

if (empty($_SESSION['is_login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .table-data { border-collapse: collapse; width: 100%; border: 1px solid #ccc; margin-top: 10px; }
        .table-data th { background-color: #333; color: white; padding: 10px; }
        .table-data td { padding: 8px; border: 1px solid #ddd; text-align: center; }
        .btn-back { background: #555; text-decoration: none; padding: 8px 15px; color: white; border-radius: 4px; }
        .btn-add { background: green; text-decoration: none; padding: 8px 15px; color: white; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>Laporan Data Transaksi</h2>
    <a href="index.php" class="btn-back">&laquo; Kembali ke Dashboard</a>
    <a href="transaksi.php" class="btn-add">+ Input Transaksi Baru</a>
    <br><br>
    
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT t.*, p.nama_pelanggan 
                      FROM transaksi t 
                      JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                      ORDER BY t.tanggal DESC";
            
            $result = mysqli_query($koneksi, $query);
            $no = 1;
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>".$no++."</td>
                        <td>".$row['tanggal']."</td>
                        <td>".$row['nama_pelanggan']."</td>
                        <td>".$row['keterangan']."</td>
                        <td align='right'>Rp ".number_format($row['total_bayar'], 0, ',', '.')."</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Belum ada data transaksi.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>