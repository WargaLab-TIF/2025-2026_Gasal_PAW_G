<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>
<?php include 'koneksi.php'; ?>
<h2>Data Supplier</h2>
<a href="supplier_tambah.php">+ Tambah Supplier</a>

<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th><th>Nama</th><th>Alamat</th><th>Telepon</th><th>Aksi</th>
</tr>
<?php
$data = mysqli_query($conn, "SELECT * FROM supplier");
while($d = mysqli_fetch_assoc($data)){
?>
<tr>
    <td><?= $d['id_supplier'] ?></td>
    <td><?= $d['nama_supplier'] ?></td>
    <td><?= $d['alamat'] ?></td>
    <td><?= $d['telepon'] ?></td>
    <td>
        <a href="supplier_edit.php?id=<?= $d['id_supplier'] ?>">Edit</a> |
        <a href="supplier_hapus.php?id=<?= $d['id_supplier'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
