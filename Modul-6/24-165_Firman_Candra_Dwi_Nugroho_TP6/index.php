<?php include "koneksi.php"; ?>

<h2>Pengelolaan Master Detail</h2>

<h3>Barang</h3>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Nama</th><th>Harga</th><th>Supplier</th><th>Action</th></tr>
<?php
$q = mysqli_query($koneksi, "SELECT * FROM barang");
while ($d = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>$d[id_barang]</td>
        <td>$d[nama_barang]</td>
        <td>$d[harga]</td>
        <td>$d[nama_supplier]</td>
        <td><a href='hapus_barang.php?id=$d[id_barang]'>Hapus</a></td>
    </tr>";
}
?>
</table>

<br>
<a href="tambah_transaksi.php">Tambah Transaksi</a>
<a href="tambah_detail.php">Tambah Detail Transaksi</a>

<h3>Transaksi</h3>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Tanggal</th><th>Keterangan</th><th>Total</th></tr>
<?php
$q = mysqli_query($koneksi, "SELECT * FROM transaksi");
while ($d = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>$d[id_transaksi]</td>
        <td>$d[waktu_transaksi]</td>
        <td>$d[keterangan]</td>
        <td>$d[total]</td>
    </tr>";
}
?>
</table>

<h3>Detail Transaksi</h3>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>ID Transaksi</th><th>Barang</th><th>Qty</th><th>Subtotal</th></tr>
<?php
$q = mysqli_query($koneksi, "SELECT * FROM transaksi_detail");
while ($d = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>$d[id_detail]</td>
        <td>$d[id_transaksi]</td>
        <td>$d[id_barang]</td>
        <td>$d[qty]</td>
        <td>$d[subtotal]</td>
    </tr>";
}
?>
</table>
