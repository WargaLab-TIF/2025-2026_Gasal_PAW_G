<?php
$koneksi = mysqli_connect("localhost", "root", "Ryan2025", "store");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

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
    .all{
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
  </style>
</head>
<body>
<div class="all">
  <h1>Pengelolaan Master Detail</h1><br>
<table class="t1">

<h2>Barang</h2>

  <tr>
    <th>ID</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Nama Supplier</th>
    <th>Action</th>
  </tr>

  <?php while($b = mysqli_fetch_assoc($query)): ?>

  <tr>

    <td><?=$b['id']?></td>
    <td><?=$b['kode_barang']?></td>
    <td><?=$b['nama_barang']?></td>
    <td><?=number_format($b['harga'])?></td>
    <td><?=$b['stok']?></td>
    <td><?=$b['nama_supplier']?></td>

    <td>   
      <div class="hps">
        <a href="hapus_barang.php?id=<?= $b['id']; ?>"
           onclick="return confirm('Yakin ingin menghapus barang ini?');">
           <button class="del">Delete</button>
        </a>
      </div>
    </td>

  </tr>
  <?php endwhile; ?>



<table class="t2">

  <h2>Transaksi</h2>

  <tr>
    <th>ID</th>
    <th>Waktu Transaksi</th>
    <th>Keterangan</th>
    <th>Total</th>
    <th>Nama Pelanggan</th>
  </tr>

  <?php while($t = mysqli_fetch_assoc($transaksi)): ?>

  <tr>
    <td><?=$t['id']?></td>
    <td><?=$t['waktu_transaksi']?></td>
    <td><?=$t['keterangan']?></td>
    <td><?=number_format($t['total'])?></td>
    <td><?=$t['nama_pelanggan']?></td>
  </tr>

  <?php endwhile; ?>
</table>

<table class="t3">

  <h2>Transaksi Detail</h2>
  
  <tr>
    <th>Transaksi ID</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Qty</th>
  </tr>

  <?php while($d = mysqli_fetch_assoc($detail)): ?>

  <tr>
    <td><?=$d['transaksi_id']?></td>
    <td><?=$d['nama_barang']?></td>
    <td><?=number_format($d['harga'])?></td>
    <td><?=$d['qty']?></td>
  </tr>

  <?php endwhile; ?>
</table>

</table>

<div class="sub">
  <a href="tambah_transaksi.php" class="btn">Tambah Transaksi</a>
  <a href="tambah_detail.php" class="btn">Tambah Transaksi Detail</a>
</div>

</div>
</body>
</html>