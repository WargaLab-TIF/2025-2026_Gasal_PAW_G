<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pengelolaan Master Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="add_transaksi.php" class="button">Add Transaksi (Master)</a>
        <a href="add_detail.php" class="button">Add Transaksi Detail</a>
    </div>
    <div class="container">
        <h2>Tabel Barang</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
            <?php
            $sql_barang = "SELECT * FROM barang";
            $query_barang = mysqli_query($koneksi, $sql_barang);
            if (!$query_barang) {
                die("Error query barang: " . mysqli_error($koneksi));
            }
            while ($DATA = mysqli_fetch_assoc($query_barang)) {
                echo "<tr>";
                echo "<td>" . $DATA['id'] . "</td>";
                echo "<td>" . $DATA['kode_barang'] . "</td>";
                echo "<td>" . $DATA['nama_barang'] . "</td>";
                echo "<td>" . $DATA['harga'] . "</td>";
                echo "<td>" . $DATA['stok'] . "</td>";
                echo "<td>
                        <a href='remove_br.php?id=" . $DATA['id'] . "' 
                           class='button-delete' 
                           onclick='return konfirmasiHapus();'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="container">
        <h2>Tabel Transaksi</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
            <?php
            $sql_trans = "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan 
                          FROM transaksi 
                          JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id 
                          ORDER BY transaksi.id DESC";
            $query_trans = mysqli_query($koneksi, $sql_trans);
            if (!$query_trans) {
                die("Error query transaksi: " . mysqli_error($koneksi));
            }
            while ($DATA = mysqli_fetch_assoc($query_trans)) {
                echo "<tr>";
                echo "<td>" . $DATA['id'] . "</td>";
                echo "<td>" . $DATA['date_transaksi'] . "</td>";
                echo "<td>" . $DATA['keterangan'] . "</td>";
                echo "<td>" . $DATA['total'] . "</td>";
                echo "<td>" . $DATA['nama_pelanggan'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="container">
        <h2>Tabel Transaksi Detail</h2>
        <table>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Total</th>
            </tr>
            <?php
            $sql_detail = "SELECT transaksi_detail.*, barang.nama_barang 
                           FROM transaksi_detail 
                           JOIN barang ON transaksi_detail.id_barang = barang.id
                           ORDER BY transaksi_detail.id_barang DESC";
            $query_detail = mysqli_query($koneksi, $sql_detail);
            if (!$query_detail) {
                die("Error query detail: " . mysqli_error($koneksi));
            }
            while ($DATA = mysqli_fetch_assoc($query_detail)) {
                echo "<tr>";
                echo "<td>" . $DATA['id_transaksi'] . "</td>";
                echo "<td>" . $DATA['nama_barang'] . "</td>";
                echo "<td>" . $DATA['qty'] . "</td>";
                echo "<td>" . $DATA['harga'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <script>
    function konfirmasiHapus() {
        var cek = confirm("Apakah anda yakin ingin menghapus data ini?");
        if (cek) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>
</html>