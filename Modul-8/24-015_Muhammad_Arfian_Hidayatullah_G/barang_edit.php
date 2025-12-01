<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>
<?php 
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id_barang=$id"));
?>

<h2>Edit Barang</h2>

<form method="POST">
    Nama Barang:<br>
    <input type="text" name="nama" value="<?= $data['nama_barang']; ?>"><br>
    Harga:<br>
    <input type="number" name="harga" value="<?= $data['harga']; ?>"><br>
    Stok:<br>
    <input type="number" name="stok" value="<?= $data['stok']; ?>"><br><br>
    <button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$_POST[nama]',
        harga='$_POST[harga]',
        stok='$_POST[stok]'
        WHERE id_barang=$id");
    header("Location: barang.php");
}
?>
