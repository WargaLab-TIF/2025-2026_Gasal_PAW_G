<?php
require_once 'config.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Hapus data transaksi
    $query = "DELETE FROM transaksi WHERE id_transaksi = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data transaksi berhasil dihapus!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus data transaksi!');
                window.location.href = 'index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID transaksi tidak valid!');
            window.location.href = 'index.php';
          </script>";
}
?>