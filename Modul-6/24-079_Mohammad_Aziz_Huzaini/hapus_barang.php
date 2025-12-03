<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $check_query = "SELECT COUNT(*) as total FROM transaksi_detail WHERE barang_id = $id";
    $check_result = mysqli_query($conn, $check_query);
    $check_data = mysqli_fetch_assoc($check_result);
    
    if ($check_data['total'] > 0) {
        echo "<script>
            alert('Tidak dapat menghapus barang!\\n\\nBarang ini sudah digunakan dalam transaksi.\\nBarang yang sudah tercatat dalam detail transaksi tidak dapat dihapus.');
            window.location.href = 'index.php';
        </script>";
    } else {
        $delete_query = "DELETE FROM barang WHERE id = $id";
        
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>
                alert('Barang berhasil dihapus!\\n\\nData barang telah berhasil dihapus dari sistem.');
                window.location.href = 'index.php';
            </script>";
        } else {
            $error_msg = addslashes(mysqli_error($conn));
            echo "<script>
                alert('Gagal menghapus barang!\\n\\nError: {$error_msg}');
                window.location.href = 'index.php';
            </script>";
        }
    }
} else {
    header("Location: index.php");
    exit();
}

mysqli_close($conn);
?>