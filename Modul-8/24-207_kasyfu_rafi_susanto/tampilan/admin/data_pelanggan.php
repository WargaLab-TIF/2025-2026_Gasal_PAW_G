<?php

require_once __DIR__ . "../../../data_base/ambil_data/data_user.php";
require_once __DIR__ . "../../../data_base/ambil_data/data_supplier.php";
require_once __DIR__ . "../../../data_base/ambil_data/data_pelanggan.php";
require_once __DIR__ . "../../../data_base/ambil_data/data_barang.php";
require_once __DIR__ . "../../../controler/auth.php";
$no = 1;

$page = "data_master"

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <title>Data-pelanggan</title>
</head>

<body>
    <div class="container w-100 d-flex justify-content-center flex-column align-items-center">
        <?php require_once __DIR__ . "/navbar.php" ?>
        <div class="mt-4 mx-2 d-flex justify-content-between">
            <h2>Daftar Pelanggan</h2> <a href="./tambah_data/tambah_data_pelanggan.php" class="btn btn-success"
                style="height: 40px;">Tambah Data</a>
        </div>
        <div class="m-2">
            <table class="table table-hover">
                <tr class="bg-primary text-white">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis-Kelamin</th>
                    <th>Nomor</th>
                    <th>Alamat</th>
                    <th>Tindakan</th>
                </tr>
                <?php if (isset($ls_pelanggan)): ?>
                    <?php foreach ($ls_pelanggan as $pelanggan): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $pelanggan["nama"] ?? "" ?></td>
                            <td><?= $pelanggan["jenis_kelamin"] ?? "" ?></td>
                            <td><?= $pelanggan["telp"] ?? "" ?></td>
                            <td><?= $pelanggan["alamat"] ?? "" ?></td>
                            <td>
                                <a href="edit_data/edit_data_pelanggan.php?id=<?= $pelanggan['id'] ?>"
                                    class="btn btn-warning">Edit</a>
                                <a href="../../data_base/hapus_data/hapus_pelanggan.php?id=<?= $pelanggan['id'] ?>"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                            <?php $no += 1 ?>
                        </tr>
                    <?php endforeach ?>
                    <?php $no = 1 ?>
                <?php endif ?>
            </table>
        </div>
    </div>
    </div>
</body>

</html>