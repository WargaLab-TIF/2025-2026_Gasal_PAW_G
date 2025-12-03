<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];
    $total = 0;

    $tanggal_hari_ini = date('Y-m-d');
    if (strtotime($waktu_transaksi) < strtotime($tanggal_hari_ini)) {
        die("Error: Tanggal transaksi tidak boleh kurang dari hari ini. <a href='tambah_transaksi.php'>Kembali</a>");
    }
    if (strlen($keterangan) < 3) {
        die("Error: Keterangan transaksi minimal harus 3 karakter. <a href='tambah_transaksi.php'>Kembali</a>");
    }


    $stmt = $koneksi->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)");
    
    $stmt->bind_param("ssis", $waktu_transaksi, $keterangan, $total, $pelanggan_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$koneksi->close();
?>