<?php
include "../cek_session.php";
include "../koneksi.php";

$id_transaksi = $_GET['id'];

// 1. Ambil Info Transaksi Master
$q_master = mysqli_query($koneksi, "SELECT p.*, pl.nama_pelanggan 
                                    FROM penjualan p 
                                    JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan 
                                    WHERE id_penjualan = '$id_transaksi'");
$master = mysqli_fetch_assoc($q_master);

// LOGIKA TAMBAH BARANG (Diproses di file yang sama agar praktis)
if (isset($_POST['tambah_barang'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah    = $_POST['jumlah'];

    // Ambil harga barang & stok
    $q_barang = mysqli_query($koneksi, "SELECT harga_jual, stok FROM barang WHERE id_barang = '$id_barang'");
    $d_barang = mysqli_fetch_assoc($q_barang);
    $harga    = $d_barang['harga_jual'];
    $subtotal = $harga * $jumlah;

    // VALIDASI: Cek apakah barang sudah ada di transaksi ini?
    $cek_duplikat = mysqli_query($koneksi, "SELECT * FROM detail_penjualan 
                                            WHERE id_penjualan = '$id_transaksi' 
                                            AND id_barang = '$id_barang'");
    
    if (mysqli_num_rows($cek_duplikat) > 0) {
        $error = "Barang ini sudah ada di list! Hapus dulu jika ingin ubah.";
    } elseif ($jumlah > $d_barang['stok']) {
        $error = "Stok tidak cukup! Sisa stok: " . $d_barang['stok'];
    } else {
        // 1. Insert ke detail_penjualan
        mysqli_query($koneksi, "INSERT INTO detail_penjualan (id_penjualan, id_barang, harga_satuan, jumlah, subtotal)
                                VALUES ('$id_transaksi', '$id_barang', '$harga', '$jumlah', '$subtotal')");
        
        // 2. Update Total di Tabel Master (Sesuai ketentuan PDF: Update otomatis)
        // Hitung ulang total semua detail
        $q_total = mysqli_query($koneksi, "SELECT SUM(subtotal) as total_baru FROM detail_penjualan WHERE id_penjualan='$id_transaksi'");
        $r_total = mysqli_fetch_assoc($q_total);
        $total_baru = $r_total['total_baru'];

        // Update tabel penjualan
        mysqli_query($koneksi, "UPDATE penjualan SET total = '$total_baru' WHERE id_penjualan = '$id_transaksi'");

        // Refresh halaman agar data muncul
        header("Location: tambah_detail.php?id=$id_transaksi&pesan=sukses");
        exit();
    }
}

// LOGIKA SELESAI TRANSAKSI
if (isset($_POST['selesai'])) {
    header("Location: transaksi.php");
    exit();
}

// Ambil List Barang yang SUDAH diinput (untuk tabel bawah)
$list_detail = mysqli_query($koneksi, "SELECT dp.*, b.nama_barang 
                                       FROM detail_penjualan dp 
                                       JOIN barang b ON dp.id_barang = b.id_barang 
                                       WHERE dp.id_penjualan = '$id_transaksi'");

// Ambil List Barang untuk Dropdown (Kecualikan yang sudah dipilih - Sesuai Ketentuan PDF)
// Logika: Tampilkan barang yang ID-nya TIDAK ADA di detail_penjualan transaksi ini
$q_dropdown = "SELECT * FROM barang 
               WHERE id_barang NOT IN (
                   SELECT id_barang FROM detail_penjualan WHERE id_penjualan = '$id_transaksi'
               ) ORDER BY nama_barang ASC";
$barang_tersedia = mysqli_query($koneksi, $q_dropdown);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Detail Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body style="background: #f2f2f2;">

<div class="container mt-4">
    <div class="alert alert-info">
        <strong>Transaksi #<?= $master['id_penjualan']; ?></strong> <br>
        Pelanggan: <?= $master['nama_pelanggan']; ?> | Tanggal: <?= $master['tanggal']; ?> <br>
        Ket: <?= $master['keterangan']; ?>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Tambah Barang</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Pilih Barang</label>
                            <select name="id_barang" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php if(mysqli_num_rows($barang_tersedia) > 0): ?>
                                    <?php while($b = mysqli_fetch_assoc($barang_tersedia)): ?>
                                        <option value="<?= $b['id_barang']; ?>">
                                            <?= $b['nama_barang']; ?> (Rp <?= number_format($b['harga_jual']); ?>)
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option value="" disabled>Semua barang sudah dipilih</option>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted">Barang yang sudah dipilih tidak muncul lagi.</small>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                        </div>
                        <button type="submit" name="tambah_barang" class="btn btn-success btn-block">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
            
            <form method="POST" class="mt-3">
                <button type="submit" name="selesai" class="btn btn-warning btn-block btn-lg" onclick="return confirm('Selesai input transaksi?')">SELESAI TRANSAKSI</button>
            </form>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Barang Transaksi Ini</div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Jml</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $grand_total = 0;
                            while($d = mysqli_fetch_assoc($list_detail)): 
                                $grand_total += $d['subtotal'];
                            ?>
                            <tr>
                                <td><?= $d['nama_barang']; ?></td>
                                <td><?= number_format($d['harga_satuan']); ?></td>
                                <td><?= $d['jumlah']; ?></td>
                                <td>Rp <?= number_format($d['subtotal']); ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <tr class="font-weight-bold bg-light">
                                <td colspan="3" class="text-right">Total Akhir:</td>
                                <td>Rp <?= number_format($grand_total); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>