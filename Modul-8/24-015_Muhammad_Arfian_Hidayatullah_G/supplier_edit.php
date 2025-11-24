<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>

<?php
include 'koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM supplier WHERE id_supplier=$id"));
?>

<h2>Edit Supplier</h2>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama" value="<?= $d['nama_supplier']; ?>"><br>
    Alamat:<br>
    <textarea name="alamat"><?= $d['alamat']; ?></textarea><br>
    Telepon:<br>
    <input type="text" name="telp" value="<?= $d['telepon']; ?>"><br><br>
    <button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE supplier SET 
        nama_supplier='$_POST[nama]',
        alamat='$_POST[alamat]',
        telepon='$_POST[telp]'
        WHERE id_supplier=$id");
    header("Location: supplier.php");
}
?>
