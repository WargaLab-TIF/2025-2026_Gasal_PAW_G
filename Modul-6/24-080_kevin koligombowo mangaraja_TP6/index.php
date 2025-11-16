<?php
include 'db.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Master-Detail — Index</title>
  <style>
    body{font-family: Arial; margin:20px;}
    table{border-collapse:collapse; width:100%; margin-bottom:20px;}
    th,td{border:1px solid #ccc; padding:8px; text-align:left;}
    th{background:#f2f2f2;}
    a.btn{display:inline-block;padding:6px 10px;background:#007bff;color:#fff;text-decoration:none;border-radius:4px;}
    .danger{background:#dc3545;}
  </style>
</head>
<body>
  <h1>Master-Detail — Toko Bunga</h1>

  <h2>Barang <a class="btn" href="barang_add.php">Tambah Barang</a></h2>
  <table>
    <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
    <?php
    $r = $conn->query("SELECT * FROM barang");
    while($row = $r->fetch_assoc()){
      echo "<tr>";
      echo "<td>{$row['id']}</td>";
      echo "<td>".htmlspecialchars($row['nama'])."</td>";
      echo "<td>Rp ".number_format($row['harga'],0,',','.')."</td>";
      echo "<td>
              <a href='barang_delete.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus barang ini?');\">Hapus</a>
            </td>";
      echo "</tr>";
    }
    ?>
  </table>

  <h2>Transaksi (Master) <a class="btn" href="tambah_transaksi.php">Tambah Transaksi</a></h2>
  <table>
    <tr><th>ID</th><th>Waktu</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>Aksi</th></tr>
    <?php
    $q = $conn->query("SELECT t.*, p.nama as pelanggan FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.id DESC");
    while($row = $q->fetch_assoc()){
      echo "<tr>";
      echo "<td>{$row['id']}</td>";
      echo "<td>{$row['waktu']}</td>";
      echo "<td>".htmlspecialchars($row['pelanggan'])."</td>";
      echo "<td>".htmlspecialchars($row['keterangan'])."</td>";
      echo "<td>Rp ".number_format($row['total'],0,',','.')."</td>";
      echo "<td><a href='tambah_detail.php?transaksi_id={$row['id']}'>Tambah Detail</a></td>";
      echo "</tr>";
    }
    ?>
  </table>

  <h2>Transaksi Detail</h2>
  
  <table>
    <tr><th>ID</th><th>Transaksi ID</th><th>Barang</th><th>Qty</th><th>Harga</th></tr>
    <?php
    $s = $conn->query("SELECT d.*, b.nama as barang FROM transaksi_detail d JOIN barang b ON d.barang_id = b.id ORDER BY d.id DESC");
    while($row = $s->fetch_assoc()){
      echo "<tr>";
      echo "<td>{$row['id']}</td>";
      echo "<td>{$row['transaksi_id']}</td>";
      echo "<td>".htmlspecialchars($row['barang'])."</td>";
      echo "<td>{$row['qty']}</td>";
      echo "<td>Rp ".number_format($row['harga'],0,',','.')."</td>";
      echo "</tr>";
    }
    ?>

  </table>
</body>
</html>
