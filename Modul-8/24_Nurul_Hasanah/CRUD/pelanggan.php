<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Tidak ada akses.");
}
?>

<h2>Data Pelanggan</h2>
<a href="pelanggan_tambah.php">+ Tambah Pelanggan</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama Pelanggan</th>
    <th>Alamat</th>
    <th>Telepon</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi, "SELECT * FROM pelanggan");

while($d = mysqli_fetch_assoc($q)){
    echo "<tr>
            <td>$d[id_pelanggan]</td>
            <td>$d[nama_pelanggan]</td>
            <td>$d[alamat]</td>
            <td>$d[telepon]</td>
            <td>
                <a href='pelanggan_edit.php?id=$d[id_pelanggan]'>Edit</a> |
                <a href='pelanggan_hapus.php?id=$d[id_pelanggan]' onclick='return confirm(\"Hapus?\")'>Hapus</a>
            </td>
          </tr>";
}
?>
</table>