<?php
require_once "../session.php";
require_level(1);
require "../conn.php";
include "../navbar.php";

$supplier = $conn->query("SELECT * FROM supplier");
?>
<h2>Tambah Barang</h2>

<form method="post" action="">
    Nama Barang:<br>
    <input type="text" name="nama" required><br><br>

    Harga:<br>
    <input type="number" name="harga" required><br><br>

    Stok:<br>
    <input type="number" name="stok" required><br><br>

    Supplier:<br>
    <select name="supplier_id" required>
        <?php while($s=$supplier->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<?php
if ($_POST) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $sup = $_POST['supplier_id'];

    $conn->query("INSERT INTO barang (nama_barang,harga,stok,supplier_id)
                  VALUES('$nama',$harga,$stok,$sup)");

    header("Location: data_barang.php");
}
?>
