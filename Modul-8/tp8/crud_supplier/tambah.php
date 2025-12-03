<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";
?>
<h2>Tambah Supplier</h2>

<form method="post">
    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Telp:<br>
    <input type="text" name="telp"><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<?php
if ($_POST) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $conn->query("INSERT INTO supplier (nama, telp, alamat)
                  VALUES ('$nama', '$telp', '$alamat')");
    header("Location: data_supplier.php");
}
?>
