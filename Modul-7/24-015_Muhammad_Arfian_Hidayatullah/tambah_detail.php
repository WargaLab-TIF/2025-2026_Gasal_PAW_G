<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang ini sudah ditambahkan di transaksi ini!');</script>";
    } else {
        $barang = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'");
        $b = mysqli_fetch_assoc($barang);
        $harga_satuan = $b['harga'];
        $harga_total = $harga_satuan * $qty;

        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                                VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')");
        
        mysqli_query($koneksi, "UPDATE barang SET stok = stok - $qty WHERE id='$barang_id'");

        mysqli_query($koneksi, "UPDATE transaksi SET total = (
            SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id'
        ) WHERE id='$transaksi_id'");

        echo "<script>alert('Detail transaksi berhasil ditambahkan!'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Detail Transaksi</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Tambah Detail Transaksi</h2>

<form method="post">
    <div class="mb-2">
        <label>Transaksi</label>
        <select name="transaksi_id" class="form-control" required>
            <option value="">-- Pilih Transaksi --</option>
            <?php
            $trx = mysqli_query($koneksi, "SELECT * FROM transaksi");
            while ($t = mysqli_fetch_assoc($trx)) {
                echo "<option value='$t[id]'>ID $t[id] - $t[keterangan]</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Barang</label>
        <select name="barang_id" class="form-control" required>
            <option value="">-- Pilih Barang --</option>
            <?php
            $barang = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($b = mysqli_fetch_assoc($barang)) {
                echo "<option value='$b[id]'>$b[nama] - Rp " . number_format($b['harga']) . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Qty</label>
        <input type="number" name="qty" class="form-control" required min="1">
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
</form>

</body>
</html>
