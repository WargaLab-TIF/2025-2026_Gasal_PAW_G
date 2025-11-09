<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu = $_POST['date_transaksi'];
    $total = $_POST['total']; // Ini tetap 0
    $id_pelanggan = $_POST['id_pelanggan'];
    $keterangan = trim($_POST['keterangan']); 
    if (strlen($keterangan) < 3) {
        echo "<script>
                alert('Keterangan harus memiliki minimal 3 karakter.');
                window.history.back(); // Kembali ke halaman form
              </script>";
        exit; 
    }
    $sql = "INSERT INTO transaksi (date_transaksi, keterangan, total, id_pelanggan) 
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    if ($stmt === false) {
         die("Gagal mempersiapkan statement: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "ssii", $waktu, $keterangan, $total, $id_pelanggan);
    $hasil = mysqli_stmt_execute($stmt);

    if ($hasil) {
        header("Location: halaman_utama.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);

} else {
    header("Location: add_transaksi.php");
    exit;
}
?>