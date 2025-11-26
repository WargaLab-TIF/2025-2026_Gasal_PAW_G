<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";

$id = $_GET['id'];
$barang = $conn->query("SELECT * FROM barang WHERE id=$id")->fetch_assoc();
$supplier = $conn->query("SELECT * FROM supplier");
?>
<h2>Edit Barang</h2>

<form method="post">
    Nama Barang:<br>
    <input type="text" name="nama" value="<?= $barang['nama_barang'] ?>" required><br><br>

    Harga:<br>
    <input type="number" name="harga" value="<?= $barang['harga'] ?>" required><br><br>

    Stok:<br>
    <input type="number" name="stok" value="<?= $barang['stok'] ?>" required><br><br>

    Supplier:<br>
    <select name="supplier_id">
        <?php while($s=$supplier->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>" <?= $s['id']==$barang['supplier_id']?'selected':'' ?>>
                <?= $s['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Update</button>
</form>

<?php
if ($_POST) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $sup  = $_POST['supplier_id'];

    $conn->query("
        UPDATE barang SET
            nama_barang='$nama',
            harga=$harga,
            stok=$stok,
            supplier_id=$sup
        WHERE id=$id
    ");

    header("Location: data_barang.php");
}
?>
