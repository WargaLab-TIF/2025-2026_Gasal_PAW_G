<?php

require_once __DIR__."../../../data_base/koneksi/koneksi.php";
require_once __DIR__."../../admin/transaksi/data_base/ambil_data/ambil_data.php";
$no = 1;
session_start();
if(!isset($_SESSION["login"])|| $_SESSION["level"] != 2){
    header("location:../../form_login.php");
}$page = "transaksi";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Master-Transaksi</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <?php require_once __DIR__. "/navbar.php" ?>
        <div class="w-auto m-3 shadow-sm">
            <div class="bg-primary d-flex align-items-center ps-2" style="height: 40px;">
                <p class="fw-bold text-white m-0">Transaksi</p>
            </div>
            <div class="m-2 ">
                <table class="table table-bordered border border-1 border-light">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ls_data as $trans):?>
                            <tr>
                                <td><?= $no?></td>
                                <td><?= $trans["id"]?></td>
                                <td><?= $trans["waktu_transaksi"]?></td>
                                <td><?= $trans["nama"]?></td>
                                <td><?= $trans["keterangan"]?></td>
                                <td>Rp<?= $trans["total"]?></td>
                                <!-- <td>
                                    <a href="" class="btn btn-info text-white">Lihat Detail</a>
                                    <a href="" class="btn btn-danger">Hapus</a>
                                </td> -->
                                <?php $no+=1 ?>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>