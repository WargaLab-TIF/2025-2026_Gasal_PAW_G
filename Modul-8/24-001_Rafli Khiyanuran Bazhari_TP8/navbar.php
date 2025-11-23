<?php
$currentLevel = getUserLevel();
?>
<nav class="navbar">
    <div class="navbar-left">
        <div class="navbar-brand">Sistem Penjualan</div>
        <ul class="navbar-menu">
            <li><a href="index.php">Home</a></li>
            <?php if ($currentLevel == 1): ?>
                <li><a href="data_master.php">Data Master</a></li>
            <?php endif; ?>
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
        </ul>
    </div>
    <div class="navbar-right">
        <div class="user-info">
            <span><?php echo htmlspecialchars($_SESSION['nama']); ?> -</span>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</nav>

