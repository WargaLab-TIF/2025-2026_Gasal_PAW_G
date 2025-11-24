<?php 
include '../../template/header.php';
include '../../koneksi.php';

$q = $conn->query("SELECT b.*, s.nama AS supplier 
                   FROM barang b 
                   LEFT JOIN supplier s ON b.supplier_id = s.id");
?>

<h2>Data Barang</h2>
<a href="tambah.php" style="color: lightgreen;"> Tambah Barang</a>
<br><br>

<table border="1" cellpadding="8" width="100%">
<tr style="background:#1F4068; color:white;">
    <th>ID</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Supplier</th>
    <th>Aksi</th>
</tr>

<?php while ($d = $q->fetch_assoc()) { ?>
<tr>
    <td><?= $d['id'] ?></td>
    <td><?= $d['kode_barang'] ?></td>
    <td><?= $d['nama_barang'] ?></td>
    <td>Rp <?= number_format($d['harga']) ?></td>
    <td><?= $d['stok'] ?></td>
    <td><?= $d['supplier'] ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $d['id'] ?>" onclick="return confirm('Hapus barang ini?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

<?php include '../../template/footer.php'; ?>
