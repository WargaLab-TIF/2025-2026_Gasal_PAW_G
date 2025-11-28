<?php
    include "fungsi.php";
    include "auth.php";

    (int)$id = htmlspecialchars($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM transaksi_detail WHERE transaksi_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $barang = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if (count($barang) == 0) {
        $stmt = $conn->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "<script>alert('Data berhasil dihapus'); window.location='transaksi.php';</script>";
    } else {
        echo "<script>alert('Transaksi tidak dapat dihapus karena digunakan dalam transaksi detail'); window.location='transaksi.php';</script>";
    }
?>