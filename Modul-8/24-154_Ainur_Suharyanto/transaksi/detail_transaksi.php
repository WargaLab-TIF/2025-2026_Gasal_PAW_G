<?php
include "../koneksi.php";

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
    .aksi{
      text-align: center;
      gap: 5px;
    }
  </style>
</head>
<body>
<div class="alt">

<table class="t3">

  <h2>Transaksi Detail</h2>
  
  <tr>
    <th>Transaksi ID</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Aksi</th>
  </tr>

  <?php while($d = mysqli_fetch_assoc($detail)): ?>

  <tr>
    <td><?=$d['transaksi_id']?></td>
    <td><?=$d['nama_barang']?></td>
    <td><?=number_format($d['harga'])?></td>
    <td><?=$d['qty']?></td>

    <td class="aksi">
    <a href="../CRUD/edit/transaksi_edit.php?id=<?= $d['transaksi_id']; ?>" class="e">Edit</a>
    <a href="../CRUD/hapus/hapus_detail.php?id=<?= $d['transaksi_id']; ?>" onclick="return confirm('Yakin hapus?')" class="h">Hapus</a>
    </td>
  </tr>

  <?php endwhile; ?>
</table>
</table>

<div class="sub">
  <a href="../CRUD/tambah/detail_tambah.php" class="btn">Tambah Transaksi Detail</a>
  <a href="/tp8/transaksi/transaksi.php" class="btn">kembali</a>
</div>

</div>
</body>
</html>