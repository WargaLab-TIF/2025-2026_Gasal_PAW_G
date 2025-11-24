<?php
include 'koneksi.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>barang</title>
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
  <h1>barang</h1>

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
</body>
</html>
