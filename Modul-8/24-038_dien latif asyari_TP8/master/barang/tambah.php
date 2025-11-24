<?php 
include '../../template/header.php';
include '../../koneksi.php';

$sup = $conn->query("SELECT * FROM supplier");
?>

<h2>Tambah Barang</h2>

<form method="POST" action="">
    <label>Kode Barang</label><br>
    <input type="text" name="kode" required><br><br>

    <label>Nama Barang</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" required><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" required><br><br>

    <label>Supplier</label><br>
    <select name="supplier_id">
        <?php while($s = $sup->fetch_assoc()) { ?>
            <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
        <?php } ?>
    </select><br><br>

    <button type="submit" name="save">SIMPAN</button>
</form>

<?php
if (isset($_POST['save'])) {
    $conn->query("INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
                  VALUES (
                    '$_POST[kode]',
                    '$_POST[nama]',
                    '$_POST[harga]',
                    '$_POST[stok]',
                    '$_POST[supplier_id]'
                  )");

    echo "<script>alert('Barang berhasil ditambah'); window.location='index.php';</script>";
}
?>

<?php include '../../template/footer.php'; ?>
