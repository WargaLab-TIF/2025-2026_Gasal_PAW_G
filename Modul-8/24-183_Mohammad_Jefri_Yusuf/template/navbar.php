<?php 
$namaUser = $_SESSION['nama'];
$levelUser = $_SESSION['level'];
?>
<div class="navbar">
    <div class="brand-logo">
        <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/index.php"><p>Warung Madura</p></a>
    </div>
    <div class="nav-items">
        <div class="nav-links">
            <div><a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/index.php">Home</a></div>

            <?php if ($levelUser == 1) : ?>
            <div class="dropdown">
                <div class="dropdown-title">Data Master ▾</div>
                <div class="dropdown-content">
                    <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/master/barang/index.php">Data Barang</a>
                    <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/master/supplier/index.php">Data Supplier</a>
                    <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/master/pelanggan/index.php">Data Pelanggan</a>
                    <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/master/user/index.php">Data User</a>
                </div>
            </div>
            <?php endif; ?>

            <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/transaksi/index.php">Transaksi</a>

            <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/laporan/index.php">Laporan</a>
        </div>
        <div class="dropdown">
            <div class="dropdown-title user-info">
                <b><?= $namaUser; ?></b> 
                (<?= ($levelUser == 1) ? 'Owner' : 'Kasir'; ?>) ▾
            </div>
            
            <div class="dropdown-content right">
                <a href="/2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/auth/logout.php" onclick="return confirm('Yakin ingin keluar?')" class="logout-btn">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>