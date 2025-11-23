<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];
    $total = 0; 
    $user_id = 1;

    if (strlen($keterangan) < 3) {
        $_SESSION['notif_error'] = "Keterangan harus minimal 3 karakter.";
        header("Location: tambah_transaksi.php");
        exit;
    }
    
    if (strtotime($waktu_transaksi) < strtotime(date('Y-m-d'))) {
        $_SESSION['notif_error'] = "Waktu transaksi tidak boleh kurang dari hari ini.";
        header("Location: tambah_transaksi.php");
        exit;
    }

    $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    
    mysqli_stmt_bind_param($stmt, "ssisi", $waktu_transaksi, $keterangan, $total, $pelanggan_id, $user_id);
    
    mysqli_stmt_execute($stmt);

    $transaksi_id_baru = mysqli_insert_id($koneksi);

    $_SESSION['notif_sukses'] = "Transaksi berhasil dibuat! Silakan tambahkan barang.";
    
    header("Location: tambah_detail.php?transaksi_id=" . $transaksi_id_baru);
    exit;

} else {
    header("Location: tambah_transaksi.php");
    exit;
}
?>