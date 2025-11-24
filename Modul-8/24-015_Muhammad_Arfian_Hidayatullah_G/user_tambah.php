<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>

<h2>Tambah User</h2>

<form method="POST">
    Username:<br>
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password"><br>
    Nama Lengkap:<br>
    <input type="text" name="nama"><br>
    Level (1=Owner, 2=Kasir):<br>
    <input type="number" name="level"><br><br>
    <button name="simpan">Simpan</button>
</form>

<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){
    mysqli_query($conn, "INSERT INTO user VALUES(NULL,'$_POST[username]',MD5('$_POST[password]'),'$_POST[nama]','$_POST[level]')");
    header("Location: user.php");
}
?>
