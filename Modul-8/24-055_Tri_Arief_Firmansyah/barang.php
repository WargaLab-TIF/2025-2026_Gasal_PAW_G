<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$data = mysqli_query($conn, "SELECT * FROM barang");
?>

<h2>Data Barang</h2>

<a href="tambah_barang.php">Tambah Barang</a><br><br>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Supplier</th>
    <th>Aksi</th>
</tr>

<?php while($b = mysqli_fetch_assoc($data)){ ?>
<tr>
    <td><?= $b['id']; ?></td>
    <td><?= $b['nama_barang']; ?></td>
    <td><?= $b['harga']; ?></td>
    <td><?= $b['stok']; ?></td>
    <td><?= $b['supplier_id']; ?></td>
    <td>
        <a href="edit_barang.php?id=<?= $b['id']; ?>">Edit</a> |
        <a href="hapus_barang.php?id=<?= $b['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
