<?php
include "koneksi.php";

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$barang = mysqli_query($koneksi, "SELECT * FROM barang");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaksi_id = $_POST["transaksi_id"];
    $barang_id = $_POST["barang_id"];
    $qty = $_POST["qty"];

    // Cek apakah barang sudah ada di transaksi yang sama
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang ini sudah ditambahkan sebelumnya!');</script>";
    } else {
        $barang_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga_satuan FROM barang WHERE id_barang='$barang_id'"));
        $harga = $barang_data['harga_satuan'] * $qty;

        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
        VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga')");

        // Update total otomatis
        mysqli_query($koneksi, "UPDATE transaksi SET total = 
            (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id')
            WHERE id_transaksi='$transaksi_id'");

        echo "<script>alert('Detail transaksi berhasil ditambahkan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 text-center">Tambah Detail Transaksi</h2>
    <form method="post" class="card p-4 shadow-lg">
        <div class="mb-3">
            <label class="form-label">Pilih Transaksi</label>
            <select name="transaksi_id" class="form-select" required>
                <option value="">-- Pilih Transaksi --</option>
                <?php while ($t = mysqli_fetch_assoc($transaksi)) { ?>
                    <option value="<?= $t['id_transaksi'] ?>">Transaksi #<?= $t['id_transaksi'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Barang</label>
            <select name="barang_id" class="form-select" required>
                <option value="">-- Pilih Barang --</option>
                <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                    <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah (Qty)</label>
            <input type="number" name="qty" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Tambah Detail</button>
    </form>
</div>
</body>
</html>