<?php 
include "auth.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }

        .navbar {
            background-color: #003d7a;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            color: white;
        }

        .navbar-title {
            font-size: 18px;
            font-weight: bold;
            margin-right: 30px;
        }

        .menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex: 1;
        }

        .menu li {
            position: relative;
            margin-right: 20px;
        }
        .logout{
            color:white
        }

        .menu a {
            color: white;
            text-decoration: none;
            padding: 8px 5px;
            display: block;
        }

        .menu a:hover {
            background-color: rgba(255,255,255,0.3);
            border-radius: 4px;
        }

        /* Dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #0055aa;
            list-style: none;
            padding: 0;
            margin-top: 5px;
            border-radius: 4px;
            min-width: 150px;
            z-index: 100;
        }

        .dropdown-menu li a {
            padding: 8px 10px;
        }

        .menu li:hover .dropdown-menu {
            display: block;
        }

        .user-box {
            color: white;
            margin-left: auto;
            position: relative;
        }

        .user-box:hover .user-dropdown {
            display: block;
        }

        .user-dropdown {
            display: none;
            background-color: #0055aa;
            position: absolute;
            right: 0;
            top: 100%;
            list-style: none;
            padding: 0;
            margin: 5px 0 0;
            border-radius: 4px;
            min-width: 120px;
        }

        .user-dropdown li a {
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            display: block;
        }

        .user-dropdown li a:hover {
            background-color: rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-title">📘 Sistem Penjualan</div>

    <ul class="menu">

        <!-- MENU UNTUK OWNER -->
        <?php if ($_SESSION['level'] == 1): ?>

            <li><a href="dashboard.php">Home</a></li>

            <li>
                <a href="#">Data Master ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="barang.php">Data Barang</a></li>
                    <li><a href="supplier.php">Data Supplier</a></li>
                    <li><a href="pelanggan.php">Data Pelanggan</a></li>
                    <li><a href="user.php">Data User</a></li>
                </ul>
            </li>

            <li><a href="data_transaksi.php">Transaksi</a></li>
            <li><a href="report_transaksi.php">Laporan</a></li>

        <!-- MENU UNTUK KASIR -->
        <?php elseif ($_SESSION['level'] == 2): ?>

            <li><a href="dashboard.php">Home</a></li>
            <li><a href="data_transaksi.php">Transaksi</a></li>
            <li><a href="report_transaksi.php">Laporan</a></li>

        <?php endif; ?>

    </ul>

    <!-- NAMA USER KANAN ATAS -->
    <div>
        <ul>
            <li class="menu"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

</div>

</body>
</html>
