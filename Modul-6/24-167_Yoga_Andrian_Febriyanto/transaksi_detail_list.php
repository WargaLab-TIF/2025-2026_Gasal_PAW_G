<?php
session_start();
require_once("./core/conn.php");
$active = "transaksi";

$transaksi_id = $_GET["id"] ?? null;

if (!$transaksi_id) {
    $_SESSION["notif"] = [
        "judul" => "Error",
        "pesan" => "ID Transaksi tidak ditemukan."
    ];
    header("Location: /MasterDetail/transaksi.php");
    exit;
}

$transaksi_sql = "SELECT * FROM transaksi WHERE id = $transaksi_id";
$transaksi_result = mysqli_query($conn, $transaksi_sql);
$transaksi_data = mysqli_fetch_assoc($transaksi_result);

$detail_sql = "SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.barang_id = b.id WHERE td.transaksi_id = $transaksi_id";
$detail_result = mysqli_query($conn, $detail_sql);
$detail_list = [];
if ($detail_result) {
    while ($row = mysqli_fetch_assoc($detail_result)) {
        $detail_list[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Detail Transaksi #<?= $transaksi_data['id'] ?></li>
                </ol>
            </nav>

            <div class="container-fluid" style="max-height: fit-content;">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informasi Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ID Transaksi:</strong> <?= $transaksi_data['id'] ?></p>
                                <p><strong>Waktu:</strong> <?= $transaksi_data['waktu_transaksi'] ?></p>
                                <p><strong>Keterangan:</strong> <?= $transaksi_data['keterangan'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Total:</strong> Rp<?= number_format($transaksi_data['total'], 0, ',', '.') ?></p>
                                <p><strong>Pelanggan ID:</strong> <?= $transaksi_data['pelanggan_id'] ?></p>
                                <p><strong>User ID:</strong> <?= $transaksi_data['user_id'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Detail Barang</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($detail_list)) : ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_list as $detail) : ?>
                                        <tr>
                                            <td><?= $detail['nama_barang'] ?></td>
                                            <td>Rp<?= number_format($detail['harga'], 0, ',', '.') ?></td>
                                            <td><?= $detail['qty'] ?></td>
                                            <td>Rp<?= number_format($detail['harga'] * $detail['qty'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>Tidak ada detail barang untuk transaksi ini.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="/MasterDetail/transaksi.php" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>