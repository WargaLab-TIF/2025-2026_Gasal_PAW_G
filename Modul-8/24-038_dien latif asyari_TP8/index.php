<?php 
include '../../template/session_check.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Dashboard Utama</h2>
<p>Selamat datang, <b><?= $_SESSION['nama'] ?></b></p>

<hr>

<!-- NAVIGASI UTAMA -->
<nav>
<?php if ($_SESSION['level'] == 1): ?>
    <!-- OWNER -->
    <a href="index.php">Home</a> |
    <a href="master/barang/index.php">Data Barang</a> |

<?php else: ?>
    <!-- KASIR -->
    <a href="index.php">Home</a> |
    <a href="transaksi.php">Transaksi</a> |
    <a href="laporan.php">Laporan</a> |
<?php endif; ?>

    <a href="logout.php" style="color: red;">Logout</a>
</nav>

<hr>

<h3>Selamat datang di Sistem Toko</h3>
<p>Silakan pilih menu di atas.</p>

</body>
</html>
