<?php include 'header.php'; ?>

<h2>Halaman Transaksi</h2>

<p>Ini adalah halaman Transaksi.  
Silakan lakukan proses transaksi sesuai modul sebelumnya.</p>

<!-- Contoh tampilan sederhana -->
<form method="POST">
    <label>Nama Barang:</label><br>
    <input type="text" name="barang"><br><br>

    <label>Jumlah:</label><br>
    <input type="number" name="jumlah"><br><br>

    <button type="submit">Simpan Transaksi</button>
</form>
