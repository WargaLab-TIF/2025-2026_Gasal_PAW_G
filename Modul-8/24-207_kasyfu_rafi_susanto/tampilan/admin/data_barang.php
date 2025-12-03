<?php

require_once __DIR__. "../../../data_base/ambil_data/data_user.php";
require_once __DIR__. "../../../data_base/ambil_data/data_supplier.php";
require_once __DIR__. "../../../data_base/ambil_data/data_pelanggan.php";
require_once __DIR__. "../../../data_base/ambil_data/data_barang.php";
require_once __DIR__. "../../../controler/auth.php";
$no = 1;

$page = "data_barang"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Data-master</title>
</head>
<body>
   <div class="container w-100 d-flex justify-content-center flex-column align-items-center">                                                                                                   
        <?php require_once __DIR__. "/navbar.php" ?>
            <div class="mt-4 mx-2 d-flex justify-content-between">
                <h2>Daftar Barang</h2> <a href="../tambah_data/tambah_data_barang.php" class="btn btn-success" style="height: 40px;">Tambah Data</a>
            </div>
            <div class="m-2">
                <table class="table table-hover">
                    <tr class="bg-primary text-white">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>ID Supplier</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php if(isset($ls_barang)): ?>
                        <?php foreach($ls_barang as $barang): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $barang["nama_barang"] ?? "" ?></td>
                                <td><?= $barang["harga"] ?? "" ?></td>
                                <td><?= $barang["stok"] ?? "" ?></td>
                                <td><?= $barang["supplier_id"] ?? "" ?></td>
                                <td>
                                    <a href="edit_data/edit_data_user.php?id=<?= $barang['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="../../data_base/hapus_data/hapus_barang.php?id=<?=$barang['id']?>" class="btn btn-danger">Hapus</a>
                                </td>
                                <?php $no+=1 ?>
                            </tr>
                        <?php endforeach ?>
                        <?php $no = 1 ?>
                    <?php endif ?>
                </table>
            </div>
        </div>