<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . "/config.php";
?>
<nav style="background:#0066cc;padding:8px;color:#fff;">
    <span style="font-weight:bold">Sistem Penjualan</span> |

    <a href="<?= BASE_URL ?>/data_master.php" style="color:#fff;margin-left:10px">Home</a>

    <?php if (isset($_SESSION['level'])): ?>

        <?php if ($_SESSION['level'] == 1): ?>
            <a href="<?= BASE_URL ?>/data_master.php" style="color:#fff;margin-left:10px">Data Master</a>
            <a href="<?= BASE_URL ?>/crud_transaksi/transaksi.php" style="color:#fff;margin-left:10px">Transaksi</a>
            <a href="<?= BASE_URL ?>/report_transaksi.php" style="color:#fff;margin-left:10px">Laporan</a>

        <?php else: ?>
            <a href="<?= BASE_URL ?>/crud_transaksi/transaksi.php" style="color:#fff;margin-left:10px">Transaksi</a>
            <a href="<?= BASE_URL ?>/report_transaksi.php" style="color:#fff;margin-left:10px">Laporan</a>
        <?php endif; ?>

        <span style="float:right">
            Halo, <?= htmlspecialchars($_SESSION['nama'] ?? '') ?> |
            <a href="<?= BASE_URL ?>/logout.php" style="color:#fff;margin-left:10px">Logout</a>
        </span>

    <?php endif; ?>
</nav>
