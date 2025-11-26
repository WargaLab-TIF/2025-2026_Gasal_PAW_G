<?php include "koneksi.php"; ?>

<form method="POST" action="">
    <label>Pilih Transaksi</label>
    <select name="id_transaksi">
        <?php
        $trx = mysqli_query($koneksi, "SELECT * FROM transaksi");
        while ($t = mysqli_fetch_assoc($trx)) {
            echo "<option value='$t[id_transaksi]'>$t[keterangan]</option>";
        }
        ?>
    </select><br>

    <label>Pilih Barang</label>
    <select name="id_barang">
        <?php
        $barang = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($b = mysqli_fetch_assoc($barang)) {
            echo "<option value='$b[id_barang]'>$b[nama_barang]</option>";
        }
        ?>
    </select><br>

    <label>Qty</label>
    <input type="number" name="qty" required><br><br>

    <button type="submit" name="simpan">Tambah Detail</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id_barang='$id_barang'"));
    $harga = $barang['harga'];
    $subtotal = $harga * $qty;

    mysqli_query($koneksi, "INSERT INTO transaksi_detail (id_transaksi, id_barang, qty, harga, subtotal)
                            VALUES ('$id_transaksi', '$id_barang', '$qty', '$harga', '$subtotal')");

    // Update total otomatis di tabel transaksi
    mysqli_query($koneksi, "
        UPDATE transaksi 
        SET total = (SELECT SUM(subtotal) FROM transaksi_detail WHERE id_transaksi='$id_transaksi')
        WHERE id_transaksi='$id_transaksi'
    ");

    echo "<script>alert('Detail transaksi berhasil ditambahkan'); window.location='index.php';</script>";
}
?>
