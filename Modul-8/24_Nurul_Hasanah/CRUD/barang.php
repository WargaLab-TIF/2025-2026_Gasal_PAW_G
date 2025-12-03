<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Maaf, anda tidak punya hak akses.");
}
?>

<h2>Data Barang</h2>
<a href="barang_tambah.php">+ Tambah Barang</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi, "SELECT * FROM barang");

while($d = mysqli_fetch_assoc($q)){
    echo "<tr>
            <td>$d[id_barang]</td>
            <td>$d[nama_barang]</td>
            <td>$d[harga]</td>
            <td>$d[stok]</td>
            <td>
                <a href='barang_edit.php?id=$d[id_barang]'>Edit</a> |
                <a href='barang_hapus.php?id=$d[id_barang]' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
            </td>
          </tr>";
}
?>
</table>