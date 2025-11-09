<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu = $_POST['waktu_transaksi'];
    $ket = $_POST['keterangan'];
    $pelanggan = $_POST['pelanggan_id'];

    if ($waktu < date('Y-m-d')) {
        echo "<script>alert('Tanggal tidak boleh sebelum hari ini!');history.back();</script>";
        exit;
    }
    if (strlen($ket) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');history.back();</script>";
        exit;
    }

    $conn->query("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                  VALUES ('$waktu', '$ket', 0, '$pelanggan')");
    echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>     Tambah Transaksi</h2>
<form method="POST">
    <label>Tanggal Transaksi</label>
    <input type="date" name="waktu_transaksi" required>

    <label>Keterangan</label>
    <textarea name="keterangan" minlength="3" required></textarea>

    <label>Pelanggan</label>
    <select name="pelanggan_id" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php
        $q = $conn->query("SELECT * FROM pelanggan");
        while ($p = $q->fetch_assoc()) {
            echo "<option value='{$p['id']}'>{$p['nama']}</option>";
        }
        ?>
    </select>

    <button type="submit">Simpan</button>
    <a href="index.php" class="btn">Kembali</a>
</form>
</body>
</html>
