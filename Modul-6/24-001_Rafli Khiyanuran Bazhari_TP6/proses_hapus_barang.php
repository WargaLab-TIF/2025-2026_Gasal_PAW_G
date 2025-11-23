<?php
require_once 'config.php';

$conn = getConnection();

if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];
    
    $delete_stmt = $conn->prepare("DELETE FROM barang WHERE id = ?");
    $delete_stmt->bind_param("i", $barang_id);
    
    if ($delete_stmt->execute()) {
        echo "<script>
            alert('Data barang berhasil dihapus');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data barang: " . $delete_stmt->error . "');
            window.location.href = 'index.php';
        </script>";
    }
    $delete_stmt->close();
} else {
    header("Location: index.php");
    exit();
}

$conn->close();
