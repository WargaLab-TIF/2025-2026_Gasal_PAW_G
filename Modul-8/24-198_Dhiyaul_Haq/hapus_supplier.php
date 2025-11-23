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
    
    $stmt = $conn->prepare("SELECT * FROM barang WHERE supplier_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $barang = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if (count($barang) == 0) {
        $stmt = $conn->prepare("DELETE FROM supplier WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "<script>alert('Data berhasil dihapus'); window.location='supplier.php';</script>";
    } else {
        echo "<script>alert('Supplier tidak dapat dihapus karena digunakan dalam barang'); window.location='supplier.php';</script>";
    }
?>