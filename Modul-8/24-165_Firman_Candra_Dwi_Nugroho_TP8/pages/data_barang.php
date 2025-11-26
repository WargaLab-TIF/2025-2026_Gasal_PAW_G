<?php
include "config.php";

// PROSES SIMPAN / TAMBAH
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, harga, stok) 
    VALUES ('$kode', '$nama', '$harga', '$stok')");

    echo "<script>alert('Data berhasil ditambahkan'); window.location='index.php?page=data_barang';</script>";
}

// PROSES HAPUS
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
    echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=data_barang';</script>";
}
?>

<h2>Data Barang</h2>

<!-- FORM TAMBAH -->
<form method="POST">
    <input type="text" name="kode_barang" placeholder="Kode Barang" required>
    <input type="text" name="nama_barang" placeholder="Nama Barang" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <input type="number" name="stok" placeholder="Stok" required>
    <button name="simpan">Tambah</button>
</form>

<br>

<!-- TABEL DATA -->
<table border="1" cellpadding="5" width="100%">
<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM barang");
$no = 1;

while ($row = mysqli_fetch_assoc($data)) :
?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['kode_barang'] ?></td>
    <td><?= $row['nama_barang'] ?></td>
    <td><?= number_format($row['harga']) ?></td>
    <td><?= $row['stok'] ?></td>
    <td>
        <a href="index.php?page=data_barang_edit&id=<?= $row['id'] ?>">Edit</a> |
        <a href="index.php?page=data_barang&hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
    </td>
</tr>

<?php endwhile; ?>
</table>
