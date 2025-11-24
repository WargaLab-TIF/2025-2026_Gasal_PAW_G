<?php
include "../proses/proteksi.php";
include "../koneksi.php";

$query = mysqli_query($koneksi, "
    SELECT b.*, s.nama AS nama_supplier
    FROM barang b
    LEFT JOIN supplier s ON b.supplier_id = s.id
");

$transaksi = mysqli_query($koneksi, "
  SELECT t.*, p.nama AS nama_pelanggan
  FROM transaksi t
  LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
  ORDER BY t.id
");

$detail = mysqli_query($koneksi, "
  SELECT d.*, b.nama_barang AS nama_barang
  FROM transaksi_detail d
  LEFT JOIN barang b ON d.barang_id = b.id
  ORDER BY d.transaksi_id
");

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pengelolaan Master Detail</title>
  <style>
    table { border-collapse: collapse; margin-bottom: 1rem; }
    th, td { border: 1px solid #444; padding: 6px; }
    .btn { background: #0b7ed1; color: white; padding: 6px 12px; text-decoration: none; border-radius: 5px; }

    tr,td {
        width: 400px;
        padding: 8px;
        margin: 4px 0;
        box-sizing: border-box;
    }
    .alt{
        width: 1000px;
        margin: auto;
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 50px;
        margin-bottom: 50px;
        border-radius: 5px;
        box-shadow: 2px 2px 12px #aaa;
    }
    th{
        background-color: #7ab7c8ff;
    }
    h2{
        text-align: center;
    }
    .sub{
        text-align: right;
        margin-top: 40px;
        margin-bottom: 20px;
    }
    a{
      text-align: center;
    }
    .del{
        text-align: center;
        background-color: #c64444ff;
        border-radius: 4px;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        width: 100px;
    }
    .hps{
        text-align: center;
    }
    .t1{
        float: left;
        margin-bottom: 80px;
    }
    .t2{
        float: left;
        margin-bottom: 80px;
    }
    .aksi{
      text-align: center;
      gap: 5px;
    }
    .e{
        background-color: #4CAF50;
        text-decoration: none;
        padding: 5px 10px;
        color: white;
        border-radius: 4px;
    }
    .h{
        background-color: #f44336;
        text-decoration: none;
        padding: 5px 10px;
        color: white;
        border-radius: 4px;
    }
  </style>
</head>
<body style="font-family: Arial;">
<?php include "../navbar.php"; ?><br>
<div class="alt">
  
<table class="t2">

  <h2>Transaksi</h2>

  <tr>
    <th>ID</th>
    <th>Waktu Transaksi</th>
    <th>Keterangan</th>
    <th>Total</th>
    <th>Nama Pelanggan</th>
    <th>Aksi</th>
  </tr>

  <?php while($t = mysqli_fetch_assoc($transaksi)): ?>

  <tr>
    <td><?=$t['id']?></td>
    <td><?=$t['waktu_transaksi']?></td>
    <td><?=$t['keterangan']?></td>
    <td><?=number_format($t['total'])?></td>
    <td><?=$t['nama_pelanggan']?></td>

    <td class="aksi">
    <a href="../CRUD/edit/transaksi_edit.php?id=<?= $t['id']; ?>" class="e">Edit</a>
    <a href="../CRUD/hapus/hapus_transaksi.php?id=<?= $t['id']; ?>" onclick="return confirm('Yakin hapus?')" class="h">Hapus</a>
    </td>
  </tr>

  <?php endwhile; ?>
</table>
</table>

<div class="sub">
  <a href="/tp8/transaksi/detail_transaksi.php" class="e">Detail</a> 
  <a href="../CRUD/tambah/tambah_transaksi.php" class="btn">Tambah Transaksi</a>
</div>

</div>
</body>
</html>