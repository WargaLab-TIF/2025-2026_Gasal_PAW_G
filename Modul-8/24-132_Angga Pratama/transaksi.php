<?php
session_start();
include 'koneksi.php';

// Cek Login (Semua Level Boleh Akses)
if (empty($_SESSION['is_login'])) {
    header("Location: login.php");
    exit;
}

// Proses Simpan Transaksi
if (isset($_POST['simpan'])) {
    $tgl   = $_POST['tanggal'];
    $id_pel = $_POST['id_pelanggan'];
    $total = $_POST['total'];
    $ket   = $_POST['keterangan'];

    $query = "INSERT INTO transaksi VALUES (NULL, '$tgl', '$id_pel', '$total', '$ket')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Transaksi Berhasil Disimpan!'); window.location='laporan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Transaksi</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0; box-sizing: border-box; }
        .btn { padding: 10px 20px; background: #2980b9; color: white; border: none; cursor: pointer; }
        .btn-back { background: #555; text-decoration: none; padding: 8px 15px; color: white; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>Input Transaksi Baru</h2>
    <a href="index.php" class="btn-back">&laquo; Kembali ke Dashboard</a>
    <br><br>

    <form method="POST" style="width: 400px; background: #f9f9f9; padding: 20px; border: 1px solid #ddd;">
        <label>Tanggal Transaksi</label>
        <input type="date" name="tanggal" required value="<?= date('Y-m-d'); ?>">

        <label>Pilih Pelanggan</label>
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php
            $q_pel = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while ($p = mysqli_fetch_assoc($q_pel)) {
                echo "<option value='".$p['id_pelanggan']."'>".$p['nama_pelanggan']."</option>";
            }
            ?>
        </select>

        <label>Total Bayar (Rp)</label>
        <input type="number" name="total" placeholder="Contoh: 50000" required>

        <label>Keterangan</label>
        <textarea name="keterangan" placeholder="Contoh: Pembelian Barang X"></textarea>
        
        <br><br>
        <button type="submit" name="simpan" class="btn">Simpan Transaksi</button>
    </form>
</body>
</html>