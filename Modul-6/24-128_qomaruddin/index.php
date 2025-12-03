<?php
require_once "./data_base/koneksi.php";
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center  flex-column align-items-center w-10" >
            <h3>Barang</h3>
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Nama Supplier</th>
                    <th>Aksi</th>
                </tr>
                <?php require_once "./data_base/ambil_data/dt_barang.php" ?>
                <?php foreach($ls_barang as $bar): ?>
                    <tr>
                        <td><?=$bar["id"]?></td>
                        <td><?=$bar["nama_barang"]?></td>
                        <td><?=$bar["harga"]?></td>
                        <td><?=$bar["stok"]?></td>
                        <td><?=$bar["supplier_id"]?></td>
                        <td><a href="./data_base/hapus/hapus_data.php?id=<?=$bar['id'];?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
        <div class="row d-flex justify-content-betweeen">
            <div class="d-flex justify-content-center  flex-column align-items-center w-50 col" >
                <h3>Transaksi</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Waktu Transaksi</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Nama Pelanggan</th>
                    </tr>
                    <?php require_once "./data_base/ambil_data/dt_transaksi.php" ?>
                    <?php foreach($ls_transaksi as $trans): ?>
                        <tr>
                            <td><?=$trans["id"]?></td>
                            <td><?=$trans["waktu_transaksi"]?></td>
                            <td><?=$trans["keterangan"]?></td>
                            <td><?=$trans["total"]?></td>
                            <td><?=$trans["pelanggan_id"]?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <div class="d-flex justify-content-center  flex-column align-items-center w-50 col" >
                <h3>Details Transaksi</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Transaksi Id</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                    </tr>
                    <?php require_once "./data_base/ambil_data/detail_transaksi.php" ?>
                    <?php foreach($ls_detail as $detail): ?>
                        <tr>
                            <td><?=$detail["transaksi_id"]?></td>
                            <td><?=$detail["barang_id"]?></td>
                            <td><?=$detail["harga"]?></td>
                            <td><?=$detail["qty"]?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <div class="row">
                <div class="col">
                    <a href="./form_input/transaksi.php" class="btn btn-primary">Tambah Transaksi</a>
                    <a href="./form_input/detail_transaksi.php" class="btn btn-primary">Tambah Detail Transaksi</a>
                </div>
            </div>
        </div>
    </div>
        
</body>
</html>