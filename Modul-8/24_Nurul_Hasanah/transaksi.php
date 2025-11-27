<?php
include "proteksi.php";
include "koneksi.php"; 

?>

<h2>Transaksi Penjualan</h2>

<form method="post" action="transaksi_simpan.php">

    <label>Pelanggan :</label>
    <select name="id_pelanggan" required>
        <option value="">Pilih Pelanggan</option>
        <?php
        $q = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while($d = mysqli_fetch_assoc($q)){
            echo "<option value='$d[id_pelanggan]'>$d[nama_pelanggan]</option>";
        }
        ?>
    </select>

    <br><br>

    <label>Barang :</label>
    <select name="id_barang" required>
        <option value="">Pilih Barang</option>
        <?php
        $barang = mysqli_query($koneksi, "SELECT * FROM barang");
        while($b = mysqli_fetch_assoc($barang)){
            echo "<option value='$b[id_barang]'>$b[nama_barang] - Rp $b[harga]</option>";
        }
        ?>
    </select>

    <br><br>

    <label>Jumlah :</label>
    <input type="number" name="qty" required>

    <br><br>

    <button type="submit" name="simpan">SIMPAN TRANSAKSI</button>
</form>