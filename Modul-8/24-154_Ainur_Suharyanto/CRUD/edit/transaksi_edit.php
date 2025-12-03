<?php
session_start();
include "../../koneksi.php";

$id = $_GET['id']; 

$q = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id='$id'");
$d = mysqli_fetch_assoc($q);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pelanggan = $_POST['pelanggan'];
    $waktu     = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $total     = $_POST['total'];

    mysqli_query($koneksi, "
        UPDATE transaksi SET 
            pelanggan_id='$pelanggan',
            waktu_transaksi='$waktu',
            keterangan='$keterangan',
            total='$total'
        WHERE id='$id'
    ");

    header("Location: ../../transaksi/transaksi.php");
    exit;
}
?>

<h2>Edit Transaksi</h2>
<form method="POST">
    <input type="hidden" name="pelanggan" value="<?= $d['pelanggan_id'] ?>">

    <label>Waktu Transaksi</label><br>
    <input type="datetime-local" name="waktu_transaksi" 
    value="<?= date('Y-m-d\TH:i', strtotime($d['waktu_transaksi'])); ?>" required><br><br>

    <label>Keterangan</label><br>
    <input type="text" name="keterangan" value="<?= $d['keterangan'] ?>"><br><br>

    <label>Total</label><br>
    <input type="number" name="total" value="<?= $d['total'] ?>"><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>
