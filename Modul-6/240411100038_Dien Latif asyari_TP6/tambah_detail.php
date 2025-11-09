<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $cek = $conn->query("SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if ($cek->num_rows > 0) {
        echo "<script>alert('Barang sudah ada di transaksi ini!');history.back();</script>";
        exit;
    }

    $barang = $conn->query("SELECT harga FROM barang WHERE id='$barang_id'")->fetch_assoc();
    $harga_total = $barang['harga'] * $qty;

    $conn->query("INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                  VALUES ('$transaksi_id', '$barang_id', '$harga_total', '$qty')");

    $conn->query("UPDATE transaksi 
                  SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id')
                  WHERE id='$transaksi_id'");

    echo "<script>alert('Detail transaksi berhasil ditambahkan!');window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Detail Transaksi</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2> Tambah Detail Transaksi</h2>
<form method="POST">
    <label>Pilih Transaksi</label>
    <select name="transaksi_id" required>
        <option value="">-- Pilih Transaksi --</option>
        <?php
        $trans = $conn->query("SELECT * FROM transaksi");
        while ($t = $trans->fetch_assoc()) {
            echo "<option value='{$t['id']}'>Transaksi #{$t['id']} - {$t['keterangan']}</option>";
        }
        ?>
    </select>

    <label>Pilih Barang</label>
    <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>
        <?php
        $barang = $conn->query("SELECT * FROM barang");
        while ($b = $barang->fetch_assoc()) {
            echo "<option value='{$b['id']}'>{$b['nama_barang']} - Rp" . number_format($b['harga'],0,',','.') . "</option>";
        }
        ?>
    </select>

    <label>Jumlah (Qty)</label>
    <input type="number" name="qty" min="1" required>

    <button type="submit">Simpan</button>
    <a href="index.php" class="btn">Kembali</a>
</form>
</body>
</html>
