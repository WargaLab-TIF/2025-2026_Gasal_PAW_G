<?php
include 'koneksi.php';
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

  </table>
</body>
</html>
