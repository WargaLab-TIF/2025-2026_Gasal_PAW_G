<?php
require 'db.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Praktikum - Dashboard</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
  <div class="container">
    <header class="page-header">
      <h1>Praktikum Toko</h1>
      <p class="subtitle">barang, pelanggan, transaksi</p>
    </header>

    <nav class="nav-links">
      <a href="pelanggan_add.php">Tambah Pelanggan</a>
      <a href="barang_add.php">Tambah Barang</a>
      <a href="transaksi_add.php">Tambah Transaksi</a>
      <a href="detail_add.php">Tambah Detail</a>
    </nav>

    <section class="card">
      <h3 class="section-title">Daftar Barang</h3>
      <table class="table">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php
        $res = $mysqli->query("SELECT * FROM barang ORDER BY id DESC");
        if ($res && $res->num_rows) {
          while ($r = $res->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="center">'.(int)$r['id'].'</td>';
            echo '<td>'.htmlspecialchars($r['nama']).'</td>';
            echo '<td class="right">'.number_format($r['harga_satuan'],0,',','.').'</td>';
            echo '<td class="center">
              <form method="post" action="barang_delete.php" onsubmit="return confirm(\'Yakin hapus?\')">
                <input type="hidden" name="id" value="'.(int)$r['id'].'">
                <button class="btn btn-danger" type="submit">Hapus</button>
              </form>
            </td>';
            echo '</tr>';
          }
        } else {
          echo '<tr class="empty"><td colspan="4" class="center">Belum ada data barang</td></tr>';
        }
        ?>
        </tbody>
      </table>
    </section>

    <section class="card">
      <h3 class="section-title">Daftar Pelanggan</h3>
      <table class="table">
        <thead><tr><th>ID</th><th>Nama</th><th>Alamat</th></tr></thead>
        <tbody>
        <?php
        $res = $mysqli->query("SELECT * FROM pelanggan ORDER BY id DESC");
        if ($res && $res->num_rows) {
          while ($r = $res->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="center">'.(int)$r['id'].'</td>';
            echo '<td>'.htmlspecialchars($r['nama']).'</td>';
            echo '<td>'.htmlspecialchars($r['alamat']).'</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr class="empty"><td colspan="3" class="center">Belum ada data pelanggan</td></tr>';
        }
        ?>
        </tbody>
      </table>
    </section>

    <section class="card">
      <h3 class="section-title">Daftar Transaksi</h3>
      <table class="table">
        <thead><tr><th>ID</th><th>Waktu</th><th>Pelanggan</th><th>Keterangan</th><th class="right">Total</th></tr></thead>
        <tbody>
        <?php
        $res = $mysqli->query("SELECT t.*, p.nama AS pelanggan FROM transaksi t JOIN pelanggan p ON t.pelanggan_id=p.id ORDER BY t.id DESC");
        if ($res && $res->num_rows) {
          while ($r = $res->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="center">'.(int)$r['id'].'</td>';
            echo '<td class="center">'.htmlspecialchars($r['waktu_transaksi']).'</td>';
            echo '<td>'.htmlspecialchars($r['pelanggan']).'</td>';
            echo '<td>'.htmlspecialchars($r['keterangan']).'</td>';
            echo '<td class="right">'.number_format($r['total'],0,',','.').'</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr class="empty"><td colspan="5" class="center">Belum ada data transaksi</td></tr>';
        }
        ?>
        </tbody>
      </table>
    </section>

    <section class="card">
      <h3 class="section-title">Daftar Detail Transaksi</h3>
      <table class="table">
        <thead><tr><th>ID</th><th>Transaksi ID</th><th>Barang</th><th>Qty</th><th class="right">Harga</th></tr></thead>
        <tbody>
        <?php
        $res = $mysqli->query("SELECT d.*, b.nama AS barang FROM transaksi_detail d JOIN barang b ON d.barang_id=b.id ORDER BY d.id DESC");
        if ($res && $res->num_rows) {
          while ($r = $res->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="center">'.(int)$r['id'].'</td>';
            echo '<td class="center">'.(int)$r['transaksi_id'].'</td>';
            echo '<td>'.htmlspecialchars($r['barang']).'</td>';
            echo '<td class="center">'.(int)$r['qty'].'</td>';
            echo '<td class="right">'.number_format($r['harga'],0,',','.').'</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr class="empty"><td colspan="5" class="center">Belum ada data detail</td></tr>';
        }
        ?>
        </tbody>
      </table>
    </section>

    <p class="small">Petunjuk: buat pelanggan → buat transaksi → tambah detail pada transaksi.</p>
  </div>
</body>
</html>
