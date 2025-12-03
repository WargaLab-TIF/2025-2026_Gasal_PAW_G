<?php

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

if (!isset($halaman_aktif)) {
    $halaman_aktif = 'home';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
    <div class="container-fluid mx-5"> 
        <a class="navbar-brand" href="index.php">Sistem Penjualan</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($halaman_aktif == 'home' ? 'active' : ''); ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <?php 
                if (!empty($args) && $args[0]['level'] == '1') { 
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo (in_array($halaman_aktif, ['barang', 'supplier', 'pelanggan', 'user']) ? 'active' : ''); ?>" href="#" id="dataMasterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dataMasterDropdown">
                            <li><a class="dropdown-item <?php echo ($halaman_aktif == 'barang' ? 'active' : ''); ?>" href="master_barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item <?php echo ($halaman_aktif == 'supplier' ? 'active' : ''); ?>" href="master_supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item <?php echo ($halaman_aktif == 'pelanggan' ? 'active' : ''); ?>" href="master_pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item <?php echo ($halaman_aktif == 'user' ? 'active' : ''); ?>" href="master_user.php">Data User</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($halaman_aktif == 'transaksi' ? 'active' : ''); ?>" href="./transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($halaman_aktif == 'laporan' ? 'active' : ''); ?>" href="./laporan.php">Laporan</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>