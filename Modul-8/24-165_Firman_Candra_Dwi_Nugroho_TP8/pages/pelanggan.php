<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
?>

<h2>Data Pelanggan</h2>
<a href="?page=pelanggan_add.php">+ Tambah Pelanggan</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Telepon</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$no}</td>
        <td>{$row['nama_pelanggan']}</td>
        <td>{$row['alamat']}</td>
        <td>{$row['no_telp']}</td>
        <td>
            <a href='?page=pelanggan_edit.php&id={$row['id_pelanggan']}'>Edit</a> |
            <a href='?page=pelanggan_hapus.php&id={$row['id_pelanggan']}' onclick=\"return confirm('Hapus data?')\">Hapus</a>
        </td>
    </tr>";
    $no++;
}
?>
</table>
