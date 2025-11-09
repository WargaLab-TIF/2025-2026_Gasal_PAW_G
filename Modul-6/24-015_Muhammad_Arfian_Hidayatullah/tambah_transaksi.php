<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];
    $total = 0;
    $hari_ini = date('Y-m-d');

    if ($waktu_transaksi < $hari_ini) {
        echo "<script>alert(' Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
    } elseif (strlen($keterangan) < 3) {
        echo "<script>alert(' Keterangan minimal 3 karakter!');</script>";
    } elseif (empty($pelanggan_id)) {
        echo "<script>alert(' Silakan pilih pelanggan terlebih dahulu!');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                                         VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')");
        if ($query) {
            echo "<script>alert(' Data transaksi berhasil disimpan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert(' Gagal menyimpan data transaksi!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Tambah Data Transaksi (Master)</h3>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold">Waktu Transaksi</label>
                    <input type="date" name="waktu_transaksi" class="form-control" required min="<?= date('Y-m-d'); ?>">
                    <div class="form-text text-muted">Tanggal tidak boleh sebelum hari ini.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan transaksi..." required></textarea>
                    <div class="form-text text-muted">Minimal 3 karakter.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Pelanggan</label>
                    <select name="pelanggan_id" class="form-select" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php
                        $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while ($p = mysqli_fetch_assoc($pelanggan)) {
                            echo "<option value='{$p['id']}'>{$p['nama']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Total</label>
                    <input type="number" name="total" class="form-control" value="0" readonly>
                    <div class="form-text text-muted">Nilai total otomatis diset 0 saat transaksi dibuat.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
