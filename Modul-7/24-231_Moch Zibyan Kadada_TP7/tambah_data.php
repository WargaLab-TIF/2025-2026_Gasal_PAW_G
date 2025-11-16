<?php
include "koneksi.php";

if (isset($_POST['tanggal'])) {

    $tglInput   = $_POST['tanggal'];
    $pelanggan  = $_POST['nama_pelanggan'];
    $ketTrans   = $_POST['keterangan'];
    $jumlahBayar = $_POST['total'];

    $query = "
        INSERT INTO transaksi (tanggal, nama_pelanggan, keterangan, total)
        VALUES ('$tglInput', '$pelanggan', '$ketTrans', '$jumlahBayar')
    ";

    $save = mysqli_query($conn, $query);

    if ($save) {
        echo "<script>
                alert('Transaksi berhasil ditambahkan.');
                window.location='data_transaksi.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan transaksi.');
                window.location='tambah_data.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Transaksi</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .header-box {
            background: #0d6efd;
            padding: 12px;
            color: #fff;
            font-size: 19px;
            font-weight: 600;
            border-radius: 6px 6px 0 0;
        }
        .content-area {
            background: #fff;
            padding: 22px;
            border: 1px solid #ccc;
            border-radius: 0 0 6px 6px;
        }
        label {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="header-box">Form Input Transaksi</div>
    <div class="content-area">
        <a href="data_transaksi.php" class="btn btn-secondary mb-3">← Kembali</a>
        <form method="POST" action="tambah_data.php">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control"
                       placeholder="Masukkan nama pelanggan..." required>
            </div>
            <div class="form-group">
                <label>Jenis Pesanan</label>
                <select name="keterangan" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Self pickup">Self Pickup</option>
                    <option value="Delivery Order">Delivery Order</option>
                </select>
            </div>
            <div class="form-group">
                <label>Total Pembayaran (Rp)</label>
                <input type="number" name="total" class="form-control"
                       placeholder="Contoh: 120000" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>