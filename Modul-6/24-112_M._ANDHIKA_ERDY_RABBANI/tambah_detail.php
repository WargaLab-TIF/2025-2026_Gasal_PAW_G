<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Detail Transaksi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
  <h2>Tambah Detail Transaksi</h2>
  <form action="simpan_detail.php" method="POST">

    <div class="mb-3">
      <label>ID Transaksi</label>
      <select name="transaksi_id" class="form-select" required>
        <option value="">-- Pilih Transaksi --</option>
        <?php
        $transaksi = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");
        while($t = mysqli_fetch_assoc($transaksi)){
          echo "<option value='{$t['id']}'>ID {$t['id']} - {$t['keterangan']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Pilih Barang</label>
      <select name="barang_id" class="form-select" required>
        <option value="">-- Pilih Barang --</option>
        <?php
        $barang = mysqli_query($conn, "SELECT * FROM barang");
        while($b = mysqli_fetch_assoc($barang)){
          echo "<option value='{$b['id']}'>{$b['nama_barang']} - Rp ".number_format($b['harga'])."</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Quantity</label>
      <input type="number" name="qty" class="form-control" min="1" required>
    </div>

    <button class="btn btn-primary">Tambah Detail</button>
  </form>
</div>
</body>
</html>
