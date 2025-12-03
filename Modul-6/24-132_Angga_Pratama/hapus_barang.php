<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];

    $stmt_check = $koneksi->prepare("SELECT barang_id FROM transaksi_detail WHERE barang_id = ?");
    $stmt_check->bind_param("i", $barang_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "<script>
                alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');
                window.location.href = 'index.php';
              </script>";
    } else {
        $stmt_delete = $koneksi->prepare("DELETE FROM barang WHERE id = ?");
        $stmt_delete->bind_param("i", $barang_id);
        
        if ($stmt_delete->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt_delete->error;
        }
        $stmt_delete->close();
    }
    $stmt_check->close();
    
} else {
    header("Location: index.php");
}

$koneksi->close();
?>