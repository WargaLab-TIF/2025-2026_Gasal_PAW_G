<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";

$id = $_GET['id'];
$p = $conn->query("SELECT * FROM pelanggan WHERE id='$id'")->fetch_assoc();
?>
<h2>Edit Pelanggan</h2>

<form method="post">
    Nama:<br>
    <input type="text" name="nama" value="<?= $p['nama'] ?>" required><br><br>

    Jenis Kelamin:<br>
    <select name="jk">
        <option value="L" <?= $p['jenis_kelamin']=="L"?"selected":"" ?>>L</option>
        <option value="P" <?= $p['jenis_kelamin']=="P"?"selected":"" ?>>P</option>
    </select><br><br>

    Telp:<br>
    <input type="text" name="telp" value="<?= $p['telp'] ?>"><br><br>

    Alamat:<br>
    <textarea name="alamat"><?= $p['alamat'] ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

<?php
if ($_POST) {
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $conn->query("UPDATE pelanggan 
                  SET nama='$nama', jenis_kelamin='$jk', telp='$telp', alamat='$alamat'
                  WHERE id='$id'");
    header("Location: data_pelanggan.php");
}
?>
