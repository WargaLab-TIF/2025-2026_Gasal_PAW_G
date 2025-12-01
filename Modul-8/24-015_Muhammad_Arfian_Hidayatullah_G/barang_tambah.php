<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>

<h2>Tambah Barang</h2>

<form method="POST">
    Nama Barang:<br>
    <input type="text" name="nama"><br>
    Harga:<br>
    <input type="number" name="harga"><br>
    Stok:<br>
    <input type="number" name="stok"><br><br>
    <button name="simpan">Simpan</button>
</form>

<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){
    mysqli_query($conn, "INSERT INTO barang VALUES(NULL,'$_POST[nama]','$_POST[harga]','$_POST[stok]',NULL)");
    header("Location: barang.php");
}
?>
