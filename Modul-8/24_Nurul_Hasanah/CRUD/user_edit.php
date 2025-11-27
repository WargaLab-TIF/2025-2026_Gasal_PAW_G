<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("No akses!");
}

$id = $_GET["id"];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'"));

if(isset($_POST["update"])){

    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $level = $_POST["level"];

    if($_POST["password"] == ""){
        mysqli_query($koneksi, "UPDATE user SET 
            username='$username',
            nama='$nama',
            level='$level'
            WHERE id='$id'
        ");
    } else {
        $pass = md5($_POST["password"]);
        mysqli_query($koneksi, "UPDATE user SET 
            username='$username',
            nama='$nama',
            password='$pass',
            level='$level'
            WHERE id='$id'
        ");
    }

    header("Location: user.php");
}
?>

<h2>Edit User</h2>

<form method="post">
    Username :
    <input type="text" name="username" value="<?= $data['username']; ?>"><br><br>

    Nama :
    <input type="text" name="nama" value="<?= $data['nama']; ?>"><br><br>

    Password (kosong = tidak diubah) :
    <input type="password" name="password"><br><br>

    Level :
    <select name="level">
        <option value="1" <?= $data['level']==1?'selected':'' ?>>Owner</option>
        <option value="2" <?= $data['level']==2?'selected':'' ?>>Kasir</option>
    </select>
    <br><br>

    <button type="submit" name="update">Update</button>
</form>