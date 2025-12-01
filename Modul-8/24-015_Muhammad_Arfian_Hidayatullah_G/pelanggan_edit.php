<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>
<?php
include 'koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan=$id"));
?>

<h2>Edit Pelanggan</h2>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama" value="<?= $d['nama_pelanggan']; ?>"><br>
    Alamat:<br>
    <textarea name="alamat"><?= $d['alamat']; ?></textarea><br>
    Telepon:<br>
    <input type="text" name="telp" value="<?= $d['telepon']; ?>"><br><br>
    <button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE pelanggan SET 
        nama_pelanggan='$_POST[nama]',
        alamat='$_POST[alamat]',
        telepon='$_POST[telp]'
        WHERE id_pelanggan=$id");
    header("Location: pelanggan.php");
}
?>
