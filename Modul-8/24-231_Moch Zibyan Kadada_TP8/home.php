<?php 
include 'cek_session.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Sistem Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            padding: 20px;
            max-width: 960px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 10px;
        }

        /* Navbar Layout */
        .navbar {
            background-color: #333;
            overflow: visible;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .navbar-brand {
            color: white;
            font-size: 24px;
            text-decoration: none;
            margin-right: 20px;
        }
        .navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Nav Items & Links */
        .nav-item {
            position: relative;
        }
        .nav-link {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            cursor: pointer;
        }
        .nav-link:hover {
            background-color: #575757;
        }

        /* Dropdown Specific Styles (FIXED) */
        .arrow-down {
            margin-left: 5px;
            font-size: 0.7em; 
            line-height: 1;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute; 
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 100;
            left: 0; 
            top: 100%;
            border-top: 3px solid #007bff;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Saat dropdown aktif (klik) */
        .dropdown-active .dropdown-content {
            display: block !important;
        }

        /* User Info and Logout Button */
        .user-info {
            color: white;
            margin-right: 20px;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }

        /* Alert Styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>

<nav class="navbar">
  <a class="navbar-brand" href="#">Sistem Penjualan</a>
  <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
    <?php if($_SESSION['level'] == 1) { ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropbtn">Data Master <span class="arrow-down">&#9660;</span></a>
      <div class="dropdown-content">
        <a href="admin_menu/barang.php">Data Barang</a>
        <a href="admin_menu/supplier.php">Data Supplier</a>
        <a href="admin_menu/pelanggan.php">Data Pelanggan</a>
        <a href="admin_menu/user.php">Data User</a>
      </div>
    </li>
    <?php } ?>

    <li class="nav-item"><a class="nav-link" href="transaksi/transaksi.php">Transaksi</a></li>
    <li class="nav-item"><a class="nav-link" href="laporan/laporan.php">Laporan</a></li>
  </ul>

  <div>
    <span class="user-info">Halo, <b><?php echo $_SESSION['nama']; ?></b> 
    (<?php echo ($_SESSION['level'] == 1) ? "Owner" : "Kasir"; ?>)</span>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>
</nav>

<div class="container">
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "akses_ditolak"){
            echo "<div class='alert alert-danger'>Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman tersebut.</div>";
        }
    }
    ?>
    
    <h1>Selamat Datang!</h1>
    <p>Anda login sebagai <b><?php echo $_SESSION['nama']; ?></b>.</p>
    <p>Hak Akses Anda adalah: <b><?php echo ($_SESSION['level'] == 1) ? "Owner (Admin Penuh)" : "Kasir (Operasional)"; ?></b></p>
</div>

<script>
    // --------- FIX DROPDOWN KLIK ----------
    document.querySelectorAll('.dropdown').forEach(function(drop){
        drop.addEventListener('click', function(e){
            e.stopPropagation();
            drop.classList.toggle('dropdown-active');
        });
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(){
        document.querySelectorAll('.dropdown').forEach(function(drop){
            drop.classList.remove('dropdown-active');
        });
    });
</script>

</body>
</html>
