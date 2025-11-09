<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    $sql_cek = "SELECT * FROM transaksi_detail WHERE id_barang = '$id_barang'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    if (!$query_cek) {
        die("Error cek hapus: " . mysqli_error($koneksi));
    }
    $jumlahh = mysqli_num_rows($query_cek);
    if ($jumlahh > 0) {
        echo "<script>
                alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');
                window.location.href = 'halaman_utama.php';
              </script>";
        exit;
    } else {
        $hapus_sql = "DELETE FROM barang WHERE id = '$id_barang'";
        $hasil = mysqli_query($koneksi, $hapus_sql);
        if ($hasil) {
            echo "<script>
                    alert('Barang berhasil dihapus.');
                    window.location.href = 'halaman_utama.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Gagal menghapus barang: " . mysqli_error($koneksi) . "');
                    window.location.href = 'halaman_utama.php';
                  </script>";
            exit;
        }
    }
} else {
    header("Location: halaman_utama.php");
    exit;
}
?>