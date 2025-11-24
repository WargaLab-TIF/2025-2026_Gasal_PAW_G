<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>

<h2>Tambah Supplier</h2>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama"><br>
    Alamat:<br>
    <textarea name="alamat"></textarea><br>
    Telepon:<br>
    <input type="text" name="telp"><br><br>
    <button name="simpan">Simpan</button>
</form>

<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){
    mysqli_query($conn, "INSERT INTO supplier VALUES(NULL,'$_POST[nama]','$_POST[alamat]','$_POST[telp]')");
    header("Location: supplier.php");
}
?>
