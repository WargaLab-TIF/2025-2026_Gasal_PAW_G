<?php
session_start();
require_once 'koneksi.php'; 

$sql_pelanggan = "SELECT id, nama FROM pelanggan";
$hasil_pelanggan = mysqli_query($koneksi, $sql_pelanggan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Transaksi</title>
</head>
<body>

    <h2>Tambah Data Transaksi</h2>
    <hr> 

    <?php if (isset($_SESSION['notif_error'])): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
            <?= $_SESSION['notif_error'] ?>
        </div>
        <?php unset($_SESSION['notif_error']); ?>
    <?php endif; ?>

    <form action="proses_tambah_transaksi.php" method="POST">
        
        <div>
            <label for="waktu_transaksi">Waktu Transaksi</label><br>
            <input type="date" id="waktu_transaksi" name="waktu_transaksi" required>
        </div>
        <br> 

        <div>
            <label for="keterangan">Keterangan</label><br>
            <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi" required></textarea>
        </div>
        <br>

        <div>
            <label for="total">Total</label><br>
            <input type="number" id="total" name="total" value="0" readonly>
        </div>
        <br>

        <div>
            <label for="pelanggan_id">Pelanggan</label><br>
            <select id="pelanggan_id" name="pelanggan_id" required>
                <option value="">Pilih Pelanggan</option>
                <?php
                while ($p = mysqli_fetch_assoc($hasil_pelanggan)) {
                    echo "<option value='" . htmlspecialchars($p['id']) . "'>" 
                       . htmlspecialchars($p['nama']) 
                       . "</option>";
                }
                ?>
            </select>
        </div>
        <br>

        <button type="submit">Tambah Transaksi</button>
    </form>

</body>
</html>