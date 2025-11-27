<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Tidak boleh akses");
}

if(isset($_POST["simpan"])){

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $nama = $_POST["nama"];
    $level = $_POST["level"];

    mysqli_query($koneksi, "INSERT INTO user VALUES(
        null, '$username', '$password', '$nama', '$level'
    )");

    header("Location: user.php");
}
?>

<h2>Tambah User</h2>

<form method="post">
    Username : <input type="text" name="username" required><br><br>
    Password : <input type="password" name="password" required><br><br>
    Nama : <input type="text" name="nama" required><br><br>

    Level :
    <select name="level" required>
        <option value="1">Owner</option>
        <option value="2">Kasir</option>
    </select>
    <br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>