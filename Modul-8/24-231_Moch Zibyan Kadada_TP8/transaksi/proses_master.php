<?php
include "../cek_session.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal      = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $keterangan   = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $total        = 0; // Default sesuai ketentuan

    // Validasi Tanggal di Sisi Server (PHP) - Sesuai Ketentuan PDF
    if (strtotime($tanggal) < time()) {
        // Jika tanggal kurang dari sekarang (toleransi detik diabaikan untuk contoh ini)
        // echo "<script>alert('Tanggal tidak boleh kurang dari hari ini!'); window.history.back();</script>";
        // exit();
        // Catatan: Biasanya 'time()' sangat presisi, untuk praktikum 'kurang dari hari ini' 
        // bisa berarti membandingkan Y-m-d saja.
        $tgl_input = date('Y-m-d', strtotime($tanggal));
        $tgl_skrg  = date('Y-m-d');
        if ($tgl_input < $tgl_skrg) {
             echo "<script>alert('Tanggal transaksi tidak boleh hari yang lalu!'); window.history.back();</script>";
             exit();
        }
    }

    // Insert ke tabel penjualan (Master)
    // Sesuaikan nama tabel 'penjualan' jika di database Anda namanya lain
    $query = "INSERT INTO penjualan (tanggal, id_pelanggan, keterangan, total) 
              VALUES ('$tanggal', '$id_pelanggan', '$keterangan', '$total')";

    if (mysqli_query($koneksi, $query)) {
        // Ambil ID Transaksi yang baru saja dibuat
        $id_transaksi = mysqli_insert_id($koneksi);
        
        // Redirect ke halaman input detail
        header("Location: tambah_detail.php?id=" . $id_transaksi);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>