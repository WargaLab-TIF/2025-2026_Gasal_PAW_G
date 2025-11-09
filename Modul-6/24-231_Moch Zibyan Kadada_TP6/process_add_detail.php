<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    $sql_cek = "SELECT * FROM transaksi_detail 
                WHERE id_transaksi = '$id_transaksi' AND id_barang = '$id_barang'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    if (!$query_cek) {
        die("Error cek duplikat: " . mysqli_error($koneksi));
    }
    if (mysqli_num_rows($query_cek) > 0) {
        die("Error: Barang ini sudah ada di transaksi tersebut. Silakan kembali.");
    }
    $sql_harga = "SELECT harga FROM barang WHERE id = '$id_barang'";
    $query_harga = mysqli_query($koneksi, $sql_harga);
    if (!$query_harga) {
        die("Error ambil harga: " . mysqli_error($koneksi));
    }
    if (mysqli_num_rows($query_harga) == 0) {
        die("Error: Barang dengan ID $id_barang tidak ditemukan.");
    }
    $harga = mysqli_fetch_assoc($query_harga);
    $harga_satuan = $harga['harga'];
    $total_harga_detail = $harga_satuan * $qty;
    $insert_sql = "INSERT INTO transaksi_detail (id_transaksi, id_barang, qty, harga) 
                   VALUES ('$id_transaksi', '$id_barang', '$qty', '$total_harga_detail')";
    $insert_hasil = mysqli_query($koneksi, $insert_sql);
    if ($insert_hasil) {
        $sql_total = "SELECT SUM(harga) AS total_baru 
                    FROM transaksi_detail 
                    WHERE id_transaksi = '$id_transaksi'";
        $query_total = mysqli_query($koneksi, $sql_total);
        if (!$query_total) {
             die("Error sum total: " . mysqli_error($koneksi));
        }
        $data_sum = mysqli_fetch_assoc($query_total);
        $total_baru = $data_sum['total_baru'] ? $data_sum['total_baru'] : 0;
        $update_sql_master = "UPDATE transaksi SET total = '$total_baru' 
                              WHERE id = '$id_transaksi'";
        mysqli_query($koneksi, $update_sql_master);
        header("Location: halaman_utama.php");
        exit;
    } else {
        echo "Gagal menyimpan detail transaksi: " . mysqli_error($koneksi);
    }
} else {
    header("Location: add_detail.php");
    exit;
}
?>