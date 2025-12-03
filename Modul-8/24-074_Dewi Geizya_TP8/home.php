<?php 
include 'auth.php'; 
include 'koneksi.php'; 

// FIX Undefined Array Key
$nama = $_SESSION['nama'] 
    ?? ($_SESSION['user']['nama'] ?? ($_SESSION['username'] ?? 'Guest'));

$level = $_SESSION['level']
    ?? ($_SESSION['user']['level'] ?? 0);
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

        /* NAVBAR EDITED (BLUE) */
        .navbar {
            background-color: #0d6efd; 
            overflow: visible;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            color: white;
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

        .nav-item { position: relative; }
        .nav-link {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            cursor: pointer;
        }
        .nav-link:hover {
            background-color: #0b5ed7;
        }

        .arrow-down {
            margin-left: 5px;
            font-size: 0.7em; 
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
            border-top: 3px solid #0d6efd;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown-active .dropdown-content {
            display: block !important;
        }

        .user-info {
            color: white;
            margin-right: 20px;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
    </style>
</head>

<body>

<nav class="navbar">
  <a class="navbar-brand" href="#">Sistem Penjualan</a>

  <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>

    <?php if($level == 1) { ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropbtn">Data Master <span class="arrow-down">&#9660;</span></a>
      <div class="dropdown-content">
        <a href="DataMaster/barang_index.php">Data Barang</a>
        <a href="DataMaster/supplier_index.php">Data Supplier</a>
        <a href="DataMaster/pelanggan_index.php">Data Pelanggan</a>
        <a href="DataMaster/user_index.php">Data User</a>
      </div>
    </li>
    <?php } ?>

    <li class="nav-item"><a class="nav-link" href="transaksi/transaksi.php">Transaksi</a></li>
    <li class="nav-item"><a class="nav-link" href="laporan/laporan_index.php">Laporan</a></li>
  </ul>

  <div>
    <span class="user-info">
        Halo, <b><?= $nama; ?></b>
        (<?= ($level == 1) ? "Owner" : "Kasir"; ?>)
    </span>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>
</nav>


<div class="container">

    <?php 
    if(isset($_GET['pesan'])) {
        if($_GET['pesan'] == "akses_ditolak"){
            echo "<div class='alert alert-danger'>Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman tersebut.</div>";
        }
    }
    ?>
    
    <h1>Selamat Datang!</h1>

    <p>Anda login sebagai <b><?= $nama; ?></b>.</p>
    <p>Hak akses Anda: <b><?= ($level == 1) ? "Owner (Admin Penuh)" : "Kasir (Operasional)"; ?></b></p>

</div>

<script>
    // Dropdown On Click
    document.querySelectorAll('.dropdown').forEach(function(drop){
        drop.addEventListener('click', function(e){
            e.stopPropagation();
            drop.classList.toggle('dropdown-active');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(){
        document.querySelectorAll('.dropdown').forEach(function(drop){
            drop.classList.remove('dropdown-active');
        });
    });
</script>

</body>
</html>
