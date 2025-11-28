<?php
include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["waktu_transaksi"];
    $keterangan = $_POST["keterangan"];
    $pelanggan_id = $_POST["pelanggan_id"];
    $error = [];

    // Validasi tanggal
    if ($tanggal < date("Y-m-d")) {
        $error[] = "Tanggal transaksi tidak boleh sebelum hari ini!";
    }

    // Validasi keterangan minimal 3 karakter
    if (strlen(trim($keterangan)) < 3) {
        $error[] = "Keterangan minimal 3 huruf!";
    }

    if (empty($error)) {
        mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
        VALUES ('$tanggal', '$keterangan', 0, '$pelanggan_id')");
        echo "<script>alert('Data transaksi berhasil disimpan!'); window.location='tambah_detail.php';</script>";
    } else {
        foreach ($error as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 text-center">Tambah Transaksi</h2>
    <form method="post" class="card p-4 shadow-lg">
        <div class="mb-3">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="date" name="waktu_transaksi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" minlength="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <select name="pelanggan_id" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                    <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan Transaksi</button>
    </form>
</div>
</body>
</html>