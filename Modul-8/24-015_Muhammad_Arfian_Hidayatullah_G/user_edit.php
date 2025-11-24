<?php include 'header.php'; ?>
<?php if ($_SESSION['level'] != 1) exit; ?>
<?php
include 'koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id=$id"));
?>

<h2>Edit User</h2>

<form method="POST">
    Username:<br>
    <input type="text" name="username" value="<?= $d['username']; ?>"><br>
    Nama Lengkap:<br>
    <input type="text" name="nama" value="<?= $d['nama_lengkap']; ?>"><br>
    Level:<br>
    <input type="number" name="level" value="<?= $d['level']; ?>"><br><br>
    <button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn, "UPDATE user SET 
        username='$_POST[username]',
        nama_lengkap='$_POST[nama]',
        level='$_POST[level]'
        WHERE id=$id");
    header("Location: user.php");
}
?>
