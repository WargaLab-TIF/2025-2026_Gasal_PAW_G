<?php
    include "fungsi.php";

    (int)$id = $_GET['id'];
    
    // query untuk pembanding ada atau tidak barang pada detail transaksi
    $query = mysqli_query($conn, "SELECT barang_id FROM transaksi_detail WHERE barang_id = $id");
    $barang = mysqli_fetch_all($query, MYSQLI_ASSOC);
    if (count($barang) == 0) {
        mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
        echo "<script>alert('Data berhasil dihapus'); window.location='Tugas-2-hapus_barang.php';</script>";
    } else {
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail'); window.location='Tugas-2-hapus_barang.php';</script>";
    }
?>