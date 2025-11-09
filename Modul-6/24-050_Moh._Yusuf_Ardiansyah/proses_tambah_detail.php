<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $barang_id = $_POST['barang_id']; 
    $transaksi_id = $_POST['transaksi_id'];
    $qty = (int)$_POST['qty'];

    $redirect_url = "tambah_detail.php?transaksi_id=" . $transaksi_id;

    if ($qty <= 0) {
        $_SESSION['notif_error'] = "Quantity harus lebih dari 0.";
        header("Location: " . $redirect_url);
        exit;
    }

    $sql_check = "SELECT COUNT(*) as total FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?";
    $stmt_check = mysqli_prepare($koneksi, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $transaksi_id, $barang_id);
    mysqli_stmt_execute($stmt_check);
    $hasil_check = mysqli_stmt_get_result($stmt_check);
    $data_check = mysqli_fetch_assoc($hasil_check);
    
    if ($data_check['total'] > 0) {
        $_SESSION['notif_error'] = "Barang ini sudah ada di transaksi tersebut.";
        header("Location: " . $redirect_url);
        exit;
    }

    $sql_harga = "SELECT harga FROM barang WHERE id = ?";
    $stmt_harga = mysqli_prepare($koneksi, $sql_harga);
    mysqli_stmt_bind_param($stmt_harga, "i", $barang_id);
    mysqli_stmt_execute($stmt_harga);
    $hasil_harga = mysqli_stmt_get_result($stmt_harga);
    $barang = mysqli_fetch_assoc($hasil_harga);

    if (!$barang) {
        $_SESSION['notif_error'] = "Barang tidak ditemukan.";
        header("Location: " . $redirect_url);
        exit;
    }
    
    $harga_satuan = $barang['harga'];

    $harga_total_item = $harga_satuan * $qty;

    $sql_insert = "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "iiii", $transaksi_id, $barang_id, $qty, $harga_total_item);
    mysqli_stmt_execute($stmt_insert);

    $sql_sum = "SELECT SUM(harga) as total_baru FROM transaksi_detail WHERE transaksi_id = ?";
    $stmt_sum = mysqli_prepare($koneksi, $sql_sum);
    mysqli_stmt_bind_param($stmt_sum, "i", $transaksi_id);
    mysqli_stmt_execute($stmt_sum);
    $hasil_sum = mysqli_stmt_get_result($stmt_sum);
    $data_sum = mysqli_fetch_assoc($hasil_sum);
    $total_transaksi = $data_sum['total_baru'];

    $sql_update = "UPDATE transaksi SET total = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($koneksi, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "di", $total_transaksi, $transaksi_id);
    mysqli_stmt_execute($stmt_update);

    $_SESSION['notif_sukses'] = "Barang berhasil ditambahkan!";
    header("Location: " . $redirect_url);
    exit;

} else {
    header("Location: tambah_detail.php");
    exit;
}
?>