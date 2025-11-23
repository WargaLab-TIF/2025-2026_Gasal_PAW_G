<?php
require_once "db.php";
require_once "auth.php";

$sql_user = "SELECT id_user, level, nama FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);

if (!$stmt_user) {
    die("Prepare statement gagal: " . $conn->error);
}

$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

$halaman_aktif = 'home'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    
    <?php require_once "navbar.php"; ?>
    
    <div class="container mt-4">
        <div class="alert alert-info">
            Selamat datang di Sistem Penjualan, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            <p class="mb-0">Akses Anda sebagai <?php echo (!empty($args) && $args[0]['level'] == '1' ? 'ADMIN' : 'KASIR'); ?>.</p>
        </div>
        
        <h3 class="mb-4">Dashboard Utama</h3>
        
        <div class="row">
            <?php if (!empty($args) && $args[0]['level'] == '1'): ?>
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Master</h5>
                            <p class="card-text">Kelola data penting sistem.</p>
                            <a href="master_barang.php" class="btn btn-light btn-sm">Akses Master</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi</h5>
                        <p class="card-text">Lakukan transaksi penjualan baru.</p>
                        <a href="transaksi.php" class="btn btn-light btn-sm">Mulai Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Laporan</h5>
                        <p class="card-text">Lihat rekapitulasi penjualan dan stok.</p>
                        <a href="laporan.php" class="btn btn-light btn-sm">Lihat Laporan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>