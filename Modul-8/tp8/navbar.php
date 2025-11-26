<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . "/config.php";
?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        color: #333;
    }

    nav {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 0;
        color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 15px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .nav-brand {
        font-weight: 700;
        font-size: 20px;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-brand::before {
        content: "🏪";
        font-size: 24px;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 5px;
        flex: 1;
        margin-left: 30px;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 14px;
    }

    .nav-links a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .nav-user {
        display: flex;
        align-items: center;
        gap: 15px;
        color: #fff;
    }

    .user-name {
        font-weight: 500;
        padding: 8px 15px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        font-size: 14px;
    }

    .logout-btn {
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 14px;
    }

    .logout-btn:hover {
        background: #f44336;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.4);
    }

    @media (max-width: 768px) {
        .nav-container {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .nav-links {
            margin-left: 0;
            flex-wrap: wrap;
        }

        .nav-user {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>

<nav>
    <div class="nav-container">
        <a href="<?= BASE_URL ?>/data_master.php" class="nav-brand">Sistem Penjualan</a>

        <?php if (isset($_SESSION['level'])): ?>
            <div class="nav-links">
                <?php if ($_SESSION['level'] == 1): ?>
                    <a href="<?= BASE_URL ?>/data_master.php">Data Master</a>
                    <a href="<?= BASE_URL ?>/crud_transaksi/transaksi.php">Transaksi</a>
                    <a href="<?= BASE_URL ?>/report_transaksi.php">Laporan</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/crud_transaksi/transaksi.php">Transaksi</a>
                    <a href="<?= BASE_URL ?>/report_transaksi.php">Laporan</a>
                <?php endif; ?>
            </div>

            <div class="nav-user">
                <span class="user-name">👤 <?= htmlspecialchars($_SESSION['nama'] ?? '') ?></span>
                <a href="<?= BASE_URL ?>/logout.php" class="logout-btn">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</nav>