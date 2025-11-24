<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

// Ambil data supplier
$supplier = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama ASC");

// Proses tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    mysqli_query($conn, "
        INSERT INTO barang (nama_barang, harga, stok, supplier_id)
        VALUES ('$nama', '$harga', '$stok', '$supplier_id')
    ");

    echo "<script>alert('Barang berhasil ditambahkan'); window.location='barang.php';</script>";
}
?>

<div class="container">

    <div class="header-row">
        <h3>Tambah Barang</h3>
        <a href="barang.php" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST">

        <div class="form-row">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>

        <div class="form-row">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-row">
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <div class="form-row">
            <label>Supplier</label>
            <select name="supplier_id" required>
                <option value="">-- Pilih Supplier --</option>
                <?php while($s = mysqli_fetch_array($supplier)){ ?>
                    <option value="<?= $s['id']; ?>"><?= $s['nama']; ?></option>
                <?php } ?>
            </select>
        </div>

        <button class="btn" type="submit">Simpan</button>

    </form>

</div>
