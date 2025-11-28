<?php
    include "fungsi.php";
    include "auth.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }

    (int)$id = htmlspecialchars($_GET['id']);
    
    // query untuk pembanding ada atau tidak barang pada detail transaksi
    $stmt = $conn->prepare("SELECT * FROM transaksi_detail WHERE barang_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $barang = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if (count($barang) == 0) {
        $stmt = $conn->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "<script>alert('Data berhasil dihapus'); window.location='barang.php';</script>";
    } else {
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail'); window.location='barang.php';</script>";
    }
?>