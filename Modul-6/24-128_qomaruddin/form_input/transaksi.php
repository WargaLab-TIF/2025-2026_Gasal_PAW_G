<?php
require_once ".././data_base/koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <form class="shadow-sm w-100 p-5 bg-white rounded-3" method="POST">
                <?php require_once ".././validasi/validasi.php";?>
                <div class="mb-3 d-flex justify-content-center">
                    <h3>Tambah Transaksi</h3>
                </div>
            <div class="mb-3">
                <label for="waktu" class="form-label fw-bold">Waktu Transaksi</label>
                <input type="date" class="form-control" id="watu" aria-describedby="emailHelp" name="waktu" value="<?=$waktu ?? '' ?>">
                <div id="emailHelp" class="form-text"><?=$error["waktu"] ??''?></div>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                <textarea class="form-control" id="keterangan" aria-describedby="emailHelp" name="keterangan" placeholder="Masukkan keterangan..."><?=$keterangan ?? '' ?></textarea>
                <div id="emailHelp" class="form-text"><?=$error["keterangan"] ??''?></div>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label fw-bold">Total</label>
                <input type="text" class="form-control" id="total" name="total" value="<?=$total ?? '0'?>">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label fw-bold">Pelanggan</label>
                <?php require_once ".././data_base/ambil_data/data_pelanggan.php" ?>
                <select class="form-select form-select-sm " style="height: 40px;" aria-label=".form-select-sm example" name="pelanggan">
                    <option selected><?=$pelanggan ?? 'Pilih Pelanggan'?></option>
                        <?php foreach($dt_pelanggan as $pel) :?>
                            <option value="<?=$pel["nama"]?? ''?>"><?=$pel["nama"]?? ''?></option>
                        <?php endforeach ?>
                    </select>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="tambah">Tambah</button>
            <a href="../index.php" class="btn btn-danger mt-3">Kembali</a>
        </form>
    </div>
</body>
</html>