<?php session_start(); include 'koneksi.php'; if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; } ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Rekap Laporan Penjualan</title>
</head>

<body>
    <h2>Rekap Laporan Penjualan</h2>
    <form method="POST" action="hasil_laporan.php">
        <a href="data_master_transaksi.php">
            < Kembali</a><br><br>
                <label>Tanggal Mulai: <input type="date" name="tanggal_mulai" required> </label><br>
                <label>Tanggal Akhir: <input type="date" name="tanggal_akhir" required> </label><br><br>
                <button type="submit">Tampilkan</button>
    </form>
</body>

</html>