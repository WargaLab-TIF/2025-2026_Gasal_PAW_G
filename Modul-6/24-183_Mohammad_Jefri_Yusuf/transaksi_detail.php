<?php 
require_once "conn.php";
require_once "functions.php";
require_once "validate.php";

$barang = getData($conn, "SELECT * FROM barang");
$transaksi = getData($conn, "SELECT * FROM transaksi");

$pelanggan = getData($conn, "SELECT id, nama FROM pelanggan");
$pelanggan_map = [];
foreach ($pelanggan as $p) {
    $pelanggan_map[$p['id']] = $p['nama']; 
}

$errors = [];

if(isset($_POST["submit"])){
    $barangID = $_POST["barang_id"];
    $transaksiID = $_POST["transaksi_id"];
    $qty = (int)$_POST["qty"];

    validateTransaksiID($errors, $transaksiID);
    validateBarangID($errors, $conn, $barangID, $transaksiID);
    validateQty($errors, $qty);

    if($errors == []){
        if(insertTransaksiDetail($conn, $transaksiID, $barangID, $qty) > 0){
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
    <title>Tambah Detail Transaksi</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/transaksi.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Detail Transaksi</h1>
        <div class="main">
            <form method="post">
                <div>
                    <label for="barang_id">Pilih Barang</label>
                    <select name="barang_id" id="barang_id">
                        <option value="">Pilih Barang</option>
                        <?php $selected_id = $_POST["barang_id"] ?? "";?>
                        <?php foreach($barang as $b): ?>
                        <?php $selected = ($b["id"] == $selected_id) ? "selected" : "";?>
                            <option value="<?=$b["id"]?>" <?= $selected ?>><?= "{$b['nama_barang']} - {$b['kode_barang']}" ?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="error"><?= $errors["barang_id"] ?? "" ?></p>
                </div>
                <div>
                    <label for="transaksi_id">ID Transaksi</label>
                    <select name="transaksi_id" id="transaksi_id">
                        <option value="">Pilih ID Transaksi</option>
                        <?php $selected_id = $_POST["transaksi_id"] ?? "";?>
                        <?php foreach($transaksi as $t):?>
                        <?php $nama_pelanggan = $pelanggan_map[$t["pelanggan_id"]]?>
                        <?php $selected = ($t["id"] == $selected_id) ? "selected" : "";?>
                            <option value="<?=$t["id"]?>" <?= $selected ?>><?= "{$t['id']} - {$nama_pelanggan}" ?></option>
                        <?php endforeach;?>
                    </select>
                    <p class="error"><?= $errors["transaksi_id"] ?? "" ?></p>
                </div>
                <div>
                    <label for="qty">Quantity</label>
                    <input type="number" name="qty" id="qty" placeholder="Masukkan jumlah barang" value="<?= $qty ?? '' ?>">
                    <p class="error"><?= $errors["qty"] ?? "" ?></p>
                </div>
                <div>
                    <button class="btn submit" type="submit" name="submit">Simpan</button>
                    <button type="button" class="btn cancel" onclick="window.location.href='index.php'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
