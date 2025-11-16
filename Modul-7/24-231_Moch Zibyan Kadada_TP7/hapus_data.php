<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: data_transaksi.php");
    exit;
}

$id = $_GET['id'];

$hapus = mysqli_query($conn, "
    DELETE FROM transaksi 
    WHERE id_transaksi = '$id'
");

if ($hapus) {
    echo "
        <script>
            alert('Data transaksi telah berhasil dihapus.');
            window.location = 'data_transaksi.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Terjadi kesalahan, data tidak dapat dihapus.');
            window.location = 'data_transaksi.php';
        </script>
    ";
}
?>
