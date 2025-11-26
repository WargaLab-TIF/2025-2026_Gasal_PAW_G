<?php
session_start();
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
<div style="display:flex; justify-content:space-between; align-items:center; background:#000; color:#fff; padding:10px;">
    <div>Penjualan</div>
    <div>
        <?php if($_SESSION['level'] == 1): ?>
            <a href="data_master.php" style="color:white; margin-right:10px;">Data Master</a>
        <?php endif; ?>
        <a href="data_master_transaksi.php" style="color:white; margin-right:10px;">Transaksi</a>
        <a href="report_transaksi.php" style="color:white; margin-right:10px;">Laporan</a>
        <a href="logout.php" style="color:white;">Logout</a>
    </div>
</div>

<h2>Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?></h2>

<?php
$q1 = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM barang");
$jumlah_barang = mysqli_fetch_assoc($q1)['jumlah'] ?? 0;

$today = date('Y-m-d');
$q2 = mysqli_prepare($conn, "SELECT COUNT(*) as jtrans, SUM(total) as pend FROM transaksi WHERE DATE(waktu_transaksi)=?");
mysqli_stmt_bind_param($q2, 's', $today);
mysqli_stmt_execute($q2);
$r2 = mysqli_stmt_get_result($q2);
$s2 = mysqli_fetch_assoc($r2);
?>
<ul>
    <li>Jumlah Barang: <?= $jumlah_barang ?></li>
    <li>Transaksi hari ini: <?= $s2['jtrans'] ?? 0 ?></li>
    <li>Total pendapatan hari ini: Rp <?= number_format($s2['pend'] ?? 0,0,',','.') ?></li>
</ul>

</body>
</html>
