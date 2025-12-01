<?php include 'header.php'; ?>
<?php 
if ($_SESSION['level'] != 1) { echo "Akses ditolak"; exit; } 
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM barang");
?>

<h2>Data Barang</h2>
<a href="barang_tambah.php">+ Tambah Barang</a>
<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while($d = mysqli_fetch_assoc($data)){ ?>
    <tr>
        <td><?= $d['id_barang'] ?></td>
        <td><?= $d['nama_barang'] ?></td>
        <td><?= $d['harga'] ?></td>
        <td><?= $d['stok'] ?></td>
        <td>
            <a href="barang_edit.php?id=<?= $d['id_barang'] ?>">Edit</a> |
            <a href="barang_hapus.php?id=<?= $d['id_barang'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
