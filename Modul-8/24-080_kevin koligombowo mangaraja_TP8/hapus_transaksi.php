<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cek apakah data ada
    $cek = $conn->query("SELECT id FROM transaksi1 WHERE id = $id");

    if ($cek->num_rows > 0) {
        // Hapus data
        $delete = $conn->query("DELETE FROM transaksi1 WHERE id = $id");

        if ($delete) {
            echo "<script>
                alert('Data transaksi berhasil dihapus!');
                window.location.href='data_transaksi.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus data!');
                window.location.href='data_transaksi.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href='data_transaksi.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak valid!');
        window.location.href='data_transaksi.php';
    </script>";
}
?>
