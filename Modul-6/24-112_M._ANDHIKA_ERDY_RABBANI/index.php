<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Modul 6 - Master Detail Penjualan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
  <h2 class="mb-4">Pengelolaan Master Detail Penjualan</h2>

  <div class="card mb-4">
    <div class="card-header"><strong>Data Barang</strong></div>
    <div class="card-body p-0">
      <table class="table table-bordered table-sm mb-0">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $barang = mysqli_query($conn, "
          SELECT b.*, s.nama AS nama_supplier
          FROM barang b
          LEFT JOIN supplier s ON b.supplier_id = s.id
        ");

        while($b = mysqli_fetch_assoc($barang)) {
          echo "<tr>
                  <td>{$b['id']}</td>
                  <td>{$b['nama_barang']}</td>
                  <td>".number_format($b['harga'])."</td>
                  <td>{$b['stok']}</td>
                  <td>{$b['nama_supplier']}</td>
                  <td>
                    <a href='hapus_barang.php?id={$b['id']}'
                       class='btn btn-sm btn-danger'
                       onclick='return confirm(\"Yakin ingin menghapus barang ini?\")'>
                       Hapus
                    </a>
                  </td>
                </tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
      <strong>Data Transaksi</strong>
      <div>
        <a href="tambah_transaksi.php" class="btn btn-primary btn-sm">Tambah Transaksi</a>
        <a href="tambah_detail.php" class="btn btn-secondary btn-sm">Tambah Detail</a>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-bordered table-sm mb-0">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Pelanggan</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $trans = mysqli_query($conn, "
          SELECT t.*, p.nama AS pelanggan
          FROM transaksi t
          LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
        ");
        while($t = mysqli_fetch_assoc($trans)) {
          echo "<tr>
                  <td>{$t['id']}</td>
                  <td>{$t['waktu_transaksi']}</td>
                  <td>{$t['keterangan']}</td>
                  <td>".number_format($t['total'])."</td>
                  <td>{$t['pelanggan']}</td>
                </tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><strong>Detail Transaksi</strong></div>
    <div class="card-body p-0">
      <table class="table table-bordered table-sm mb-0">
        <thead class="table-light">
          <tr>
            <th>ID Transaksi</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $detail = mysqli_query($conn, "
          SELECT td.*, b.nama_barang
          FROM transaksi_detail td
          JOIN barang b ON b.id = td.barang_id
        ");
        while($d = mysqli_fetch_assoc($detail)) {
          echo "<tr>
                  <td>{$d['transaksi_id']}</td>
                  <td>{$d['nama_barang']}</td>
                  <td>{$d['qty']}</td>
                  <td>".number_format($d['harga'])."</td>
                </tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</body>
</html>
