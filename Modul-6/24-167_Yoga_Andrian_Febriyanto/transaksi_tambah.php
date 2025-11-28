<?php
session_start();
require_once("./core/conn.php");
$active = "transaksi";

$pelanggan_sql = "SELECT id, nama FROM pelanggan";
$pelanggan_result = mysqli_query($conn, $pelanggan_sql);
$pelanggan_list = [];
if ($pelanggan_result) {
    while ($row = mysqli_fetch_assoc($pelanggan_result)) {
        $pelanggan_list[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Tambah Transaksi</li>
                </ol>
            </nav>

            <div class="container-fluid" style="max-height: fit-content;">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Data Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <form action="./proses/transaksi/transaksi_tambah_proses.php" method="POST">
                            <div class="mb-3">
                                <label for="waktu_transaksi" class="form-label">Waktu Transaksi</label>
                                <input type="date" class="form-control" id="waktu_transaksi" name="waktu_transaksi" required min="<?= date('Y-m-d') ?>">
                                <div class="form-text">Tanggal tidak boleh kurang dari hari ini.</div>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required minlength="3" placeholder="Masukkan keterangan transaksi..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" class="form-control" id="total" name="total" value="0" required min="0">
                            </div>
                            <div class="mb-3">
                                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                                    <option value="">Pilih Pelanggan</option>
                                    <?php foreach ($pelanggan_list as $pel): ?>
                                        <option value="<?= $pel['id'] ?>"><?= $pel['nama'] ?> (ID: <?= $pel['id'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="/MasterDetail/transaksi.php" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary" name="submit">Simpan Transaksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>