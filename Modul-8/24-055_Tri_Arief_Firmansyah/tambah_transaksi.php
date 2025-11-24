<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$barang = mysqli_query($conn, "SELECT * FROM barang");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // menerima satu line item (simple)
    $pelanggan_id = mysqli_real_escape_string($conn, $_POST['pelanggan_id']);
    $user_id = $_SESSION['id_user'];
    $barang_id = intval($_POST['barang_id']);
    $qty = intval($_POST['qty']);

    // ambil harga barang
    $bq = mysqli_query($conn, "SELECT harga, stok FROM barang WHERE id=$barang_id");
    $b = mysqli_fetch_assoc($bq);
    $harga = $b['harga'];
    $subtotal = $harga * $qty;

    // insert transaksi
    $tanggal = date('Y-m-d');
    mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES ('$tanggal', 'Penjualan', $subtotal, '$pelanggan_id', $user_id)");
    $trans_id = mysqli_insert_id($conn);

    // insert detail
    mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($trans_id, $barang_id, $harga, $qty)");

    // update stok (opsional)
    $newstok = max(0, $b['stok'] - $qty);
    mysqli_query($conn, "UPDATE barang SET stok=$newstok WHERE id=$barang_id");

    header("Location: transaksi.php");
    exit;
}
?>
<div class="container" style="max-width:700px">
  <h2>Tambah Transaksi</h2>
  <form method="post">
    <div class="form-row">
      <label>Pelanggan</label>
      <select name="pelanggan_id" required>
        <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
          <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="form-row">
      <label>Barang</label>
      <select name="barang_id" required>
        <?php
        mysqli_data_seek($barang, 0);
        while($b = mysqli_fetch_assoc($barang)): ?>
          <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['nama_barang']) ?> - Rp <?= number_format($b['harga']) ?> (stok: <?= $b['stok'] ?>)</option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="form-row">
      <label>Qty</label>
      <input type="number" name="qty" value="1" min="1">
    </div>

    <button class="btn">Simpan Transaksi</button>
    <a class="btn btn-secondary" href="transaksi.php">Batal</a>
  </form>
</div>
