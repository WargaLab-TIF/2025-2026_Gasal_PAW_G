<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Maaf, anda tidak punya hak akses.");
}
?>

<h2>Data Supplier</h2>
<a href="supplier_tambah.php">+ Tambah Supplier</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama Supplier</th>
    <th>Alamat</th>
    <th>Telepon</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi, "SELECT * FROM supplier");

while($d = mysqli_fetch_assoc($q)){
    echo "<tr>
            <td>$d[id_supplier]</td>
            <td>$d[nama_supplier]</td>
            <td>$d[alamat]</td>
            <td>$d[telepon]</td>
            <td>
                <a href='supplier_edit.php?id=$d[id_supplier]'>Edit</a> |
                <a href='supplier_hapus.php?id=$d[id_supplier]' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
            </td>
          </tr>";
}
?>
</table>