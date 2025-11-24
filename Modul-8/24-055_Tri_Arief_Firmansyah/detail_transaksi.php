<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$id = intval($_GET['id'] ?? 0);
$q = mysqli_query($conn, "SELECT t.*, p.nama as pelanggan_nama, u.nama as user_nama FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
    JOIN user u ON t.user_id = u.id_user
    WHERE t.id=$id");
$t = mysqli_fetch_assoc($q);
if(!$t){
    echo "<div class='container'>Transaksi tidak ditemukan</div>"; exit;
}
$det = mysqli_query($conn, "SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.barang_id = b.id WHERE td.transaksi_id=$id");
?>
<div class="container">
  <h2>Detail Transaksi #<?= $id ?></h2>
  <p><strong>Tanggal:</strong> <?= $t['waktu_transaksi'] ?> | <strong>Pelanggan:</strong> <?= htmlspecialchars($t['pelanggan_nama']) ?> | <strong>User:</strong> <?= htmlspecialchars($t['user_nama']) ?></p>

  <table>
    <tr><th>Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
    <?php while($d = mysqli_fetch_assoc($det)): ?>
      <tr>
        <td><?= htmlspecialchars($d['nama_barang']) ?></td>
        <td><?= number_format($d['harga']) ?></td>
        <td><?= $d['qty'] ?></td>
        <td><?= number_format($d['harga'] * $d['qty']) ?></td>
      </tr>
    <?php endwhile; ?>
    <tr>
      <td colspan="3" style="text-align:right"><strong>Total</strong></td>
      <td><strong><?= number_format($t['total']) ?></strong></td>
    </tr>
  </table>

  <a class="btn" href="transaksi.php">Kembali</a>
</div>
