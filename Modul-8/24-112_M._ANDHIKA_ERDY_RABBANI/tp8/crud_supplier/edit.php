<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";

$id = $_GET['id'];
$s = $conn->query("SELECT * FROM supplier WHERE id=$id")->fetch_assoc();
?>
<h2>Edit Supplier</h2>

<form method="post">
    Nama:<br>
    <input type="text" name="nama" value="<?= $s['nama'] ?>" required><br><br>

    Telp:<br>
    <input type="text" name="telp" value="<?= $s['telp'] ?>"><br><br>

    Alamat:<br>
    <textarea name="alamat"><?= $s['alamat'] ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

<?php
if ($_POST) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $conn->query("
        UPDATE supplier SET
            nama='$nama', telp='$telp', alamat='$alamat'
        WHERE id=$id
    ");

    header("Location: data_supplier.php");
}
?>
