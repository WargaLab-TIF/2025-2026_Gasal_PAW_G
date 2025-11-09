<?php
require_once 'config.php';

$conn = getConnection();

if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];
    
    $check_query = "SELECT COUNT(*) as count FROM transaksi_detail WHERE barang_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $barang_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_data = $check_result->fetch_assoc();
    $check_stmt->close();
    
    if ($check_data['count'] > 0) {
        echo "<script>
            alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                window.location.href = 'proses_hapus_barang.php?id=" . $barang_id . "';
            } else {
                window.location.href = 'index.php';
            }
        </script>";
    }
} else {
    header("Location: index.php");
    exit();
}

$conn->close();
