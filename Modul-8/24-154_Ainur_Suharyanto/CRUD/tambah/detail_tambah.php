<?php
include "../../koneksi.php";

$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = $_POST['barang_id'];
    $transaksi_id = $_POST['transaksi_id'];
    $qty = $_POST['qty'];

    if (empty($barang_id)) $errors[] = "Pilih barang.";
    if (empty($transaksi_id)) $errors[] = "Pilih transaksi.";
    if ($qty <= 0) $errors[] = "Qty harus lebih dari 0.";

    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) $errors[] = "Barang sudah ada di transaksi tersebut.";

    if (!$errors) {
        $b = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'"));
        $harga = $b['harga'] * $qty;

        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)VALUES ('$transaksi_id','$barang_id','$qty','$harga')");

        $sum = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(harga) AS total FROM transaksi_detail WHERE transaksi_id='$transaksi_id'"));
        $total = $sum['total'];
        mysqli_query($koneksi, "UPDATE transaksi SET total='$total' WHERE id='$transaksi_id'");

        header("Location: ../../transaksi/detail_transaksi.php");
        exit;
    }
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tambah Detail Transaksi</title>
    <style>
input, select, textarea {
        width: 400px;
        padding: 8px;
        margin: 4px 0;
        box-sizing: border-box;
    }
    .sub{
        text-align: center;
    }
    a{
        text-decoration: none;
        padding-top: 5px;
        padding-bottom: 9px;
        padding-left: 50px;
        padding-right: 50px;
        background-color: #f44336;
        color: white;
        border-radius: 4px;
    }
    button{
        padding: 8px  14px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .all{
        width: 400px;
        margin: auto;
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 50px;
        border-radius: 5px;
        box-shadow: 2px 2px 12px #aaa;
    }
    </style>
  </head>
<body>
<div class="all">
<h2>Tambah Detail Transaksi</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
<form method="post">
<table>
<tr>
  <td>
  <label>Pilih Barang</label><br>
  <select name="barang_id">
    <option value="">Pilih Barang</option>
    <?php while($b=mysqli_fetch_assoc($barang)): ?>
      <option value="<?=$b['id']?>"><?=$b['nama_barang']?> - <?=number_format($b['harga'])?></option>
    <?php endwhile; ?>
  </select><br><br>
  </td>
</tr>
  
<tr>
  <td>
  <label>ID Transaksi</label><br>
  <select name="transaksi_id">
    <option value="">Pilih Transaksi</option>
    <?php while($t=mysqli_fetch_assoc($transaksi)): ?>
      <option value="<?=$t['id']?>"><?=$t['id']?> - <?=$t['pelanggan_id']?></option>
    <?php endwhile; ?>
  </select><br><br>
  </td>
</tr>
  
<tr>
  <td>
  <label>Quantity</label><br>
  <input type="number" name="qty"><br><br>
  </td>
</tr>
  
<td class="sub">
  <button type="submit">Tambah Detail Transaksi</button>
  <a href="../../transaksi/detail_transaksi.php">Kembali</a>
</td>
</table>
</form>
</div>
</body>
</html>