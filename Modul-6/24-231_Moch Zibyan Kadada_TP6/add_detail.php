<?php
include 'koneksi.php';
$sql_br = "SELECT id, nama_barang FROM barang ORDER BY nama_barang";
$query_br = mysqli_query($koneksi, $sql_br);
if (!$query_br) { 
    die("Error query barang: " . mysqli_error($koneksi));
}

$sql_transaksi = "SELECT id, CONCAT(id, ' - ', keterangan) AS info 
              FROM transaksi ORDER BY id DESC";
$query_transaksi = mysqli_query($koneksi, $sql_transaksi);
if (!$query_transaksi) { 
    die("Error query transaksi: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Detail Transaksi</h2>
        <form action="process_add_detail.php" method="POST">
            
            <label for="id_transaksi">ID Transaksi:</label>
            <select id="id_transaksi" name="id_transaksi" required>
                <option value="">Pilih ID Transaksi</option>
                <?php
                while ($data = mysqli_fetch_assoc($query_transaksi)) {
                    echo "<option value='" . $data['id'] . "'>" . $data['info'] . "</option>";
                }
                ?>
            </select>
            
            <label for="id_barang">Pilih Barang:</label>
            <select id="id_barang" name="id_barang" required>
                <option value="">Pilih Barang</option>
                 <?php
                while ($data = mysqli_fetch_assoc($query_br)) {
                    echo "<option value='" . $data['id'] . "'>" . $data['nama_barang'] . "</option>";
                }
                ?>
            </select>
            
            <label for="qty">Quantity:</label>
            <input type="number" id="qty" name="qty" min="1" required 
                   placeholder="Masukkan jumlah barang">
            
            <button type="submit">Tambah Detail Transaksi</button>
        </form>
         <br>
        <a href="Halaman_utama.php" class="button">Kembali ke Index</a>
    </div>
</body>
</html>