<?php
session_start();
require_once("./core/conn.php");
$active = "barang";

$barang_sql = "SELECT * FROM barang ORDER BY id DESC";
$barang_result = mysqli_query($conn, $barang_sql);
$barang_list = [];
if ($barang_result) {
    while ($row = mysqli_fetch_assoc($barang_result)) {
        $barang_list[] = $row;
    }
    if (count($barang_list) == 0) {
        $barang_list = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Barang</li>
                </ol>
            </nav>

            <div class="container-fluid" style="max-height: fit-content;">
                <div class="d-flex" style="width: 100%; justify-content: end; gap: 20px; margin-bottom: 20px;">
                    <a type="button" class="btn btn-primary" href="/MasterDetail/barang_tambah.php">
                        <i class="fa fa-plus"></i>
                        Tambah Data Barang
                    </a>
                </div>
                <?php if ($barang_list) : ?>
                    <table class="table table-striped" style="color: #888888;">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Supplier ID</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barang_list as $brg) : ?>
                                <tr>
                                    <th scope="row"><?= $brg["id"] ?></th>
                                    <td><?= $brg["nama_barang"] ?></td>
                                    <td><?= $brg["harga"] ?></td>
                                    <td><?= $brg["stok"] ?></td>
                                    <td><?= $brg["supplier_id"] ?></td>
                                    <td style="color: white;">
                                        <a type="button" class="btn btn-primary" href="/MasterDetail/barang_detail.php?id=<?= $brg['id'] ?>">Detail</a>
                                        <a type="button" class="btn btn-danger" href="/MasterDetail/proses/supplier/hapus_barang.php?id=<?= $brg['id'] ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 100px; font-size: 46px;">
                        Tidak Ada Data Barang
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>