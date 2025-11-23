<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:index.php");
    exit();
}

$level = $_SESSION['level'];
$nama = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Penjualan</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Home</a>
                    </li>

                    <?php if ($level == "1") { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Data Master
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dashboard.php?page=barang">Data Barang</a></li>
                                <li><a class="dropdown-item" href="dashboard.php?page=supplier">Data Supplier</a></li>
                                <li><a class="dropdown-item" href="dashboard.php?page=pelanggan">Data Pelanggan</a></li>
                                <li><a class="dropdown-item" href="dashboard.php?page=user">Data User</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=transaksi">Transaksi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?page=laporan">Laporan</a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="logout.php">LOGOUT (<?php echo $nama; ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // INI LOGIKA BIAR HALAMAN GANTI-GANTI TANPA HILANG NAVBAR
        if(isset($_GET['page'])){
            $page = $_GET['page'];

            switch ($page) {
                case 'barang':
                    include "data_barang.php"; // Pastikan lo punya file ini
                    break;
                case 'supplier':
                    include "data_supplier.php"; // Pastikan lo punya file ini
                    break;
                case 'pelanggan':
                    include "data_pelanggan.php"; // Pastikan lo punya file ini
                    break;
                case 'user':
                    include "data_user.php"; // Pastikan lo punya file ini
                    break;
                case 'transaksi':
                    include "transaksi.php"; // Pastikan lo punya file ini
                    break;
                case 'laporan':
                    include "laporan.php"; // Pastikan lo punya file ini
                    break;
                default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
            }
        } else {
            ?>
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Halo, <?php echo $nama; ?>!</h1>
                    <p class="col-md-8 fs-4">Selamat datang di Penjualan. Anda login sebagai level <?php echo $level; ?>.</p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>