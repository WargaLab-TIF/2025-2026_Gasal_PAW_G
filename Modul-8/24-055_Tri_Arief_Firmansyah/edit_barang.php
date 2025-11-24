<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$id = $_GET['id'];
$barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id = '$id'"));

$supplier = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama ASC");

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    mysqli_query($conn, "
        UPDATE barang SET
        nama_barang = '$nama',
        harga = '$harga',
        stok = '$stok',
        supplier_id = '$supplier_id'
        WHERE id = '$id'
    ");

    echo "<script>alert('Barang berhasil diupdate'); window.location='barang.php';</script>";
}
?>

<div class="container">

    <div class="header-row">
        <h3>Edit Barang</h3>
        <a href="barang.php" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST">

        <div class="form-row">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required>
        </div>

        <div class="form-row">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" value="<?= $barang['harga'] ?>" required>
        </div>

        <div class="form-row">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $barang['stok'] ?>" required>
        </div>

        <div class="form-row">
            <label>Supplier</label>
            <select name="supplier_id" required>
                <?php while($s = mysqli_fetch_array($supplier)){ ?>
                <option value="<?= $s['id']; ?>"
                    <?= $barang['supplier_id'] == $s['id'] ? 'selected' : '' ?>>
                    <?= $s['nama']; ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <button class="btn" type="submit">Update</button>

    </form>

</div>
