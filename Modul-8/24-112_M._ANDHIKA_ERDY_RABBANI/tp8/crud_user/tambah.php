<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";
?>
<h2>Tambah User</h2>

<form method="post">
    Username:<br>
    <input type="text" name="username" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    HP:<br>
    <input type="text" name="hp"><br><br>

    Level:<br>
    <select name="level">
        <option value="1">Owner</option>
        <option value="2">Kasir</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<?php
if ($_POST) {
    $user = $_POST['username'];
    $pass = $_POST['password']; // saran: gunakan password_hash()
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];

    $conn->query("
        INSERT INTO user (username, password, nama, alamat, hp, level)
        VALUES ('$user', '$pass', '$nama', '$alamat', '$hp', $level)
    ");

    header("Location: data_user.php");
}
?>
