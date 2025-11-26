<?php include "koneksi.php"; ?>

<form method="POST" action="">
    <label>Waktu Transaksi</label>
    <input type="date" name="waktu_transaksi" required><br>

    <label>Keterangan</label>
    <input type="text" name="keterangan" required><br>

    <label>Pelanggan</label>
    <select name="id_pelanggan">
        <?php
        $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($p = mysqli_fetch_assoc($pelanggan)) {
            echo "<option value='$p[id_pelanggan]'>$p[nama_pelanggan]</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" name="simpan">Tambah Transaksi</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $tgl = $_POST['waktu_transaksi'];
    $ket = $_POST['keterangan'];
    $pel = $_POST['id_pelanggan'];

    $cekTanggal = date('Y-m-d');
    if ($tgl > $cekTanggal) {
        echo "<script>alert('Tanggal tidak boleh melebihi hari ini!');</script>";
    } else {
        mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, id_pelanggan) VALUES ('$tgl', '$ket', '$pel')");
        echo "<script>alert('Transaksi berhasil ditambahkan'); window.location='index.php';</script>";
    }
}
?>
