<?php
include "../../koneksi.php";

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama");
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu = $_POST['waktu_transaksi'];
    $ket = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];
    $today = date('Y-m-d');

    if ($waktu < $today) $errors[] = "Tanggal tidak boleh sebelum hari ini.";
    if (strlen($ket) < 3) $errors[] = "Keterangan minimal 3 karakter.";
    if (empty($pelanggan_id)) $errors[] = "Pilih pelanggan.";

    if (!$errors) {
        mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
        VALUES ('$waktu', '$ket', 0, '$pelanggan_id')");
        header("Location: ../../transaksi/transaksi.php");
        exit;
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tambah Transaksi</title>
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
        padding-left: 40px;
        padding-right: 40px;
        background-color: #f44336;
        color: white;
        border-radius: 4px;
    }
    button{
        padding: 8px  20px;
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
<h2>Tambah Transaksi</h2>
<?php foreach($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
<form method="post">

<table>
    <tr>
      <td>
        <label>Waktu Transaksi</label><br>
        <input type="date" name="waktu_transaksi"><br><br>
    </td>
  </tr>

  <tr>
    <td>
      <label>Keterangan</label><br>
      <textarea name="keterangan"></textarea><br><br>
    </td>
  </tr>

  <tr>
    <td>
      <label>Total</label><br>
    <input type="number" name="total" value="0" readonly><br><br>
    </td>
  </tr>


  <tr>
    <td>
      <label>Pelanggan</label><br>
    <select name="pelanggan_id">
      <option value="">Pilih Pelanggan</option>
      <?php while($p=mysqli_fetch_assoc($pelanggan)): ?>
        <option value="<?=$p['id']?>"><?=$p['nama']?></option>
      <?php endwhile; ?>
    </select><br><br>
    </td>
  </tr>

    <td class="sub">
        <button type="submit">Tambah Transaksi</button>
        <a href="../../transaksi/transaksi.php">Kembali</a>
    </td>

  </table>

</form>
</div>
</body>
</html>
