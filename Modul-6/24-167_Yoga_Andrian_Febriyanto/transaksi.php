<?php
session_start();
require_once("./core/conn.php");
$active = "transaksi";

$transaksi = null;
$transaksi_sql = "SELECT * FROM transaksi ORDER BY waktu_transaksi DESC";
if ($sql = mysqli_query($conn, $transaksi_sql)) {
    $transaksi = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $transaksi[] = $row;
    }
    if (count($transaksi) == 0) {
        $transaksi = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
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
            <div class="container-fluid" style="max-height: fit-content;">
                <div class="d-flex" style="width: 100%; justify-content: end; gap: 20px; margin-bottom: 20px;">
                    <a type="button" class="btn btn-primary" href="/MasterDetail/transaksi_tambah.php">
                        <i class="fa fa-plus"></i>
                        Tambah Data Transaksi
                    </a>
                </div>
                <?php if ($transaksi) : ?>
                    <table class="table table-striped" style="color: #888888;">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelanggan ID</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi as $trans) : ?>
                                <tr>
                                    <th scope="row"><?= $trans["id"] ?></th>
                                    <td><?= $trans["waktu_transaksi"] ?></td>
                                    <td><?= substr($trans["keterangan"], 0, 20) . "..." ?></td>
                                    <td><?= $trans["total"] ?></td>
                                    <td><?= $trans["pelanggan_id"] ?></td>
                                    <td style="color: white;">
                                        <a type="button" class="btn btn-primary" href="/MasterDetail/transaksi_detail_list.php?id=<?= $trans['id'] ?>">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 100px; font-size: 46px;">
                        Tidak Ada Data Transaksi
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>