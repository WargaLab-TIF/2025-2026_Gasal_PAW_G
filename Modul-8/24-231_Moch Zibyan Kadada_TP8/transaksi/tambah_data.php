<?php
include "../cek_session.php";
include "../koneksi.php";

// Ambil data pelanggan untuk dropdown
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");

// Validasi Tanggal: Tidak boleh kurang dari hari ini
$today = date('Y-m-d\TH:i');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Transaksi Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body style="background: #f2f2f2;">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Langkah 1: Data Transaksi (Master)</h5>
        </div>
        <div class="card-body">
            <form action="proses_master.php" method="POST">
                
                <div class="form-group">
                    <label>Waktu Transaksi</label>
                    <input type="datetime-local" class="form-control" name="tanggal" 
                           min="<?= $today; ?>" value="<?= $today; ?>" required>
                    <small class="text-muted">Tanggal tidak boleh kurang dari waktu sekarang.</small>
                </div>

                <div class="form-group">
                    <label>Pelanggan</label>
                    <select class="form-control" name="id_pelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while ($p = mysqli_fetch_assoc($pelanggan)): ?>
                            <option value="<?= $p['id_pelanggan']; ?>">
                                <?= $p['nama_pelanggan']; ?> - <?= $p['alamat']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3" minlength="3" required placeholder="Masukkan keterangan transaksi..."></textarea>
                </div>

                <div class="form-group">
                    <label>Total Awal</label>
                    <input type="text" class="form-control" value="0">
                    <input type="hidden" name="total" value="0">
                </div>

                <hr>
                <a href="transaksi.php" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary float-right">Simpan & Lanjut ke Detail →</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>