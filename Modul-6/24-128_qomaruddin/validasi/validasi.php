<?php
// require_once ".././data_base/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tambah"])) {
    require_once ".././validasi/validasi_detail.php";
}

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
                <div class="mb-3 d-flex justify-content-center">
                    <h3>Tambah Detail Transaksi</h3>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label fw-bold">Pilih Barang</label>
                    <?php require_once ".././data_base/ambil_data/dt_barang.php" ?>
                    <select class="form-select form-select-sm " style="height: 40px;" aria-label=".form-select-sm example" name="barang">
                        <option selected><?=$barang ?? 'Pilih Barang'?></option>
                        <?php foreach($ls_barang as $bar): ?>
                            <option value="<?=$bar["nama_barang"] ?? '' ?>"><?=$bar["nama_barang"]?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label fw-bold">ID Transaksi</label>
                    <?php require_once ".././data_base/ambil_data/id_transaksi.php" ?>
                    <select class="form-select form-select-sm " style="height: 40px;" aria-label=".form-select-sm example" name="id_transaksi">
                        <option selected><?=$id_transaksi ?? 'Pilih ID Transaksi'?></option>
                        <?php foreach($ls_transaksi as $tras): ?>
                            <option value="<?=$tras["id"] ?? '' ?>"><?=$tras["id"]?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label fw-bold">Quantity</label>
                    <input type="text" class="form-control" id="total" name="quantity" value="<?=$total ?? '0'?>">
                </div>
            <button type="submit" class="btn btn-primary w-100" name="tambah">Tambah</button>
            <a href="../index.php" class="btn btn-danger mt-3">Kembali</a>
        </form>
    </div>
</body>
</html>
