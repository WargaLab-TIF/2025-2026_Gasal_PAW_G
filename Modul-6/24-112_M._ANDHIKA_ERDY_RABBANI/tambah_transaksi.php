<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Data Transaksi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
  <h2>Tambah Data Transaksi</h2>
  <form action="simpan_transaksi.php" method="POST">
    <div class="mb-3">
      <label>Waktu Transaksi</label>
      <input type="date" name="waktu_transaksi" class="form-control" required min="<?= date('Y-m-d'); ?>">
    </div>

    <div class="mb-3">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control" minlength="3" required></textarea>
    </div>

    <div class="mb-3">
      <label>Total</label>
      <input type="number" name="total" value="0" class="form-control" readonly>
    </div>

    <div class="mb-3">
      <label>Pelanggan</label>
      <select name="pelanggan_id" class="form-select" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php
        $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
        while($p = mysqli_fetch_assoc($pelanggan)){
          echo "<option value='{$p['id']}'>{$p['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <button class="btn btn-primary">Tambah Transaksi</button>
  </form>
</div>
</body>
</html>
