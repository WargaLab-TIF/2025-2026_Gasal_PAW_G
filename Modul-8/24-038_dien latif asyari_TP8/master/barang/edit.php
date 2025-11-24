<?php 
include '../../template/header.php';
include '../../koneksi.php';

$id = $_GET['id'];

$q = $conn->query("SELECT * FROM barang WHERE id=$id");
$d = $q->fetch_assoc();

$sup = $conn->query("SELECT * FROM supplier");
?>

<h2>Edit Barang</h2>

<form method="POST" action="">
    <label>Kode Barang</label><br>
    <input type="text" name="kode" value="<?= $d['kode_barang'] ?>"><br><br>

    <label>Nama Barang</label><br>
    <input type="text" name="nama" value="<?= $d['nama_barang'] ?>"><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" value="<?= $d['harga'] ?>"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="<?= $d['stok'] ?>"><br><br>

    <label>Supplier</label><br>
    <select name="supplier_id">
        <?php while($s = $sup->fetch_assoc()) { ?>
            <option value="<?= $s['id'] ?>" 
                <?= ($s['id'] == $d['supplier_id'] ? 'selected' : '') ?>>
                <?= $s['nama'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit" name="update">UPDATE</button>
</form>

<?php
if (isset($_POST['update'])) {
    $conn->query("UPDATE barang SET
                    kode_barang='$_POST[kode]',
                    nama_barang='$_POST[nama]',
                    harga='$_POST[harga]',
                    stok='$_POST[stok]',
                    supplier_id='$_POST[supplier_id]'
                  WHERE id=$id");

    echo "<script>alert('Barang berhasil diupdate'); window.location='index.php';</script>";
}
?>

<?php include '../../template/footer.php'; ?>
