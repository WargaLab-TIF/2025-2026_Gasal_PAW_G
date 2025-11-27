<?php 

require_once "conn.php";
require_once "functions.php";
require_once "validate.php";

$pelanggan = getData($conn, "SELECT id, nama FROM pelanggan");
$errors = [];
if(isset($_POST["submit"])){
    $waktuTransaksi = $_POST["waktu_transaksi"];
    $keterangan = htmlspecialchars($_POST["keterangan"]);
    $total = (int)$_POST["total"];
    $pelangganID = $_POST["pelanggan_id"];

    validateWaktuTransaksi($errors, $waktuTransaksi);
    validateKeterangan($errors, $keterangan);
    validatePelangganID($errors, $pelangganID);

    if($errors == []){
        if(insertDataTransaksi($conn, $waktuTransaksi, $keterangan, $total, $pelangganID) > 0){
            echo "
                <script> 
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php'
                </script>
            ";
            } else {
            echo "
                <script> 
                alert('Data gagal ditambahkan');
                document.location.href = 'index.php'
                </script>
            ";
            }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Transaksi</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/transaksi.css">

</head>
<body>
    <div class="container">
        <h1>Tambah Data Transaksi</h1>
        <div class="main">
            <form method="post">
                <div>
                    <label for="waktu_transaksi">Waktu Transaksi</label>
                    <input type="date" name="waktu_transaksi" id="waktu_transaksi" value="<?= $waktuTransaksi ?? "" ?>">
                    <p class="error"><?= $errors["waktu_transaksi"] ?? "" ?></p>
                </div>
                <div>
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" placeholder="Masukkan keterangan transaksi"><?= $keterangan ?? "" ?></textarea>
                    <p class="error"><?= $errors["keterangan"] ?? "" ?></p>
                </div>
                <div>
                    <label for="total">Total</label>
                    <input type="number" name="total" id="total" value="0" readonly>
                </div>
                <div>
                    <label for="pelanggan_id">Pelanggan</label>
                    <select name="pelanggan_id" id="pelanggan_id" >
                        <option value="">Pilih Pelanggan</option>
                        <?php $selected_id = $_POST["pelanggan_id"] ?? "";?>
                        <?php foreach($pelanggan as $p): ?>
                        <?php $selected = ($p["id"] == $selected_id) ? "selected" : "";?>
                            <option value="<?=$p["id"]?>" <?= $selected ?>><?= "{$p['nama']} - {$p['id']}" ?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="error"><?= $errors["pelanggan_id"] ?? "" ?></p>
                </div>
                <div>
                    <button class="btn submit" type="submit" name="submit">Simpan</button>
                    <button type="button" class="btn cancel" onclick="window.location.href='transaksi.php'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>