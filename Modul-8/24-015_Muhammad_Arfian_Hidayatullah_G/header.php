<?php
session_start();

if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

$level = $_SESSION['level'];
?>

<div style="background:#0059b3; color:white; padding:10px;">
    <strong>Sistem Penjualan</strong> |
    <a href="index.php" style="color:white;">Home</a> |

    <?php if ($level == 1) { ?>
        <a href="master.php" style="color:white;">Data Master</a> |
        <a href="transaksi.php" style="color:white;">Transaksi</a> |
        <a href="laporan.php" style="color:white;">Laporan</a> |
    <?php } ?>

    <?php if ($level == 2) { ?>
        <a href="transaksi.php" style="color:white;">Transaksi</a> |
        <a href="laporan.php" style="color:white;">Laporan</a> |
    <?php } ?>

    <span style="float:right;">
        <?= $_SESSION['username']; ?> |
        <a href="logout.php" style="color:yellow;">Logout</a>
    </span>
</div>
