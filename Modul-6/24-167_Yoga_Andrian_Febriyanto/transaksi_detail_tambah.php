<?php
session_start();
require_once("./core/conn.php");
$active = "transaksi";

$transaksi_id = $_GET["transaksi_id"] ?? null;

if (!$transaksi_id) {
    $_SESSION["notif"] = [
        "judul" => "Error",
        "pesan" => "ID Transaksi tidak ditemukan."
    ];
    header("Location: /MasterDetail/transaksi_tambah.php");
    exit;
}

$barang_sql = "SELECT id, nama_barang, harga FROM barang";
$barang_result = mysqli_query($conn, $barang_sql);
$barang_list = [];
if ($barang_result) {
    while ($row = mysqli_fetch_assoc($barang_result)) {
        $barang_list[] = $row;
    }
}

$transaksi_sql = "SELECT id, keterangan FROM transaksi WHERE id = $transaksi_id";
$transaksi_result = mysqli_query($conn, $transaksi_sql);
$transaksi_data = mysqli_fetch_assoc($transaksi_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <script defer src="./package/jquery/jquery.js"></script>
    <script defer src="./js/sidebar.js"></script>
    <script defer src="./js/main.js"></script>
    <link rel="stylesheet" href="./package/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/pelanggan.css">
    <link rel="stylesheet" href="./css/main.css">
    <script defer src="./package/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php if (isset($_SESSION["notif"])) : ?>
        <?php
        require_once "include/notif/notif.php";
        unset($_SESSION["notif"]);
        ?>
    <?php endif; ?>

    <div class="wrapper d-flex align-items-stretch" style="overflow: hidden;">
        <?php require_once __DIR__ . "/include/sidebar.php" ?>

        <div id="content" class="p-4 p-md-5 pt-5" style="overflow: auto; height: 100vh;">
            <nav aria-label="breadcrumb" style="z-index: -1;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Admin</li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Detail Transaksi</li>
                </ol>
            </nav>

            <div class="container-fluid" style="max-height: fit-content;">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Detail Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <form action="./proses/transaksi/transaksi_detail_tambah_proses.php" method="POST">
                            <input type="hidden" name="transaksi_id" value="<?= $transaksi_id ?>">

                            <div class="mb-3">
                                <label for="barang_id" class="form-label">Pilih Barang</label>
                                <select class="form-select" id="barang_id" name="barang_id" required>
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($barang_list as $brg): ?>
                                        <option value="<?= $brg['id'] ?>"><?= $brg['nama_barang'] ?> (Harga: Rp<?= number_format($brg['harga'], 0, ',', '.') ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="transaksi_id_display" class="form-label">ID Transaksi</label>
                                <input type="text" class="form-control" id="transaksi_id_display" value="<?= $transaksi_data['id'] ?> - <?= $transaksi_data['keterangan'] ?>" readonly>
    
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity (Jumlah)</label>
                                <input type="number" class="form-control" id="qty" name="qty" required min="1" placeholder="Masukkan jumlah barang...">
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="/MasterDetail/transaksi.php" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary" name="submit">Simpan Detail Transaksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>