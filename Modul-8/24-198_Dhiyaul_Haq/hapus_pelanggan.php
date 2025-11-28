<?php
    include "fungsi.php";
    include "auth.php";
    include "conn.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }

    $id = htmlspecialchars($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM transaksi WHERE pelanggan_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $barang = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if (count($barang) == 0) {
        $stmt = $conn->prepare("DELETE FROM pelanggan WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        echo "<script>alert('Data berhasil dihapus'); window.location='pelanggan.php';</script>";
    } else {
        echo "<script>alert('Pelanggan tidak dapat dihapus karena digunakan dalam transaksi'); window.location='pelanggan.php';</script>";
    }
?>