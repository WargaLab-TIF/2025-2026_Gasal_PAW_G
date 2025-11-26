<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";
?>
<h2>Tambah Pelanggan</h2>

<form method="post">
    ID Pelanggan:<br>
    <input type="text" name="id" required><br><br>

    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Jenis Kelamin:<br>
    <select name="jk">
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select><br><br>

    Telp:<br>
    <input type="text" name="telp"><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<?php
if ($_POST) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $conn->query("INSERT INTO pelanggan VALUES ('$id', '$nama', '$jk', '$telp', '$alamat')");
    header("Location: data_pelanggan.php");
}
?>
