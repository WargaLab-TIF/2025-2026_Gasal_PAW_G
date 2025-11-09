<?php
session_start();
require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $barang_id = (int)$_GET['id'];

    $sql_check = "SELECT COUNT(*) as total FROM transaksi_detail WHERE barang_id = ?";
    $stmt_check = mysqli_prepare($koneksi, $sql_check);
    
    mysqli_stmt_bind_param($stmt_check, "i", $barang_id);
    mysqli_stmt_execute($stmt_check);
    
    $hasil_check = mysqli_stmt_get_result($stmt_check);
    $data_check = mysqli_fetch_assoc($hasil_check);
    
    if ($data_check['total'] > 0) {
        $_SESSION['notif_error'] = "Barang tidak dapat dihapus karena digunakan dalam transaksi detail.";
    } else {
        $sql_delete = "DELETE FROM barang WHERE id = ?";
        $stmt_delete = mysqli_prepare($koneksi, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "i", $barang_id);
        
        if (mysqli_stmt_execute($stmt_delete)) {
            $_SESSION['notif_sukses'] = "Barang berhasil dihapus.";
        } else {
            $_SESSION['notif_error'] = "Gagal menghapus barang.";
        }
    }
} else {
    $_SESSION['notif_error'] = "ID barang tidak valid.";
}

header("Location: tampil_barang.php");
exit;
?>