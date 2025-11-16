<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input, select { padding: 7px; width: 250px; margin-bottom: 10px; }
        button { padding: 8px 20px; background: green; color: white; border: none; border-radius: 4px; }
    </style>
</head>

<body>

<h2>Tambah Transaksi</h2>

<form action="proses_tambah_transaksi.php" method="POST">

    <label>Tanggal:</label><br>
    <input type="datetime-local" name="tanggal" required><br>

    <label>ID Pelanggan:</label><br>
    <input type="number" name="pelanggan_id" placeholder="Masukkan ID Pelanggan" required><br>

    <label>Total Transaksi (Rp):</label><br>
    <input type="number" name="total" placeholder="Total transaksi" required><br>

    <button type="submit">Simpan Transaksi</button>

</form>

</body>
</html>
