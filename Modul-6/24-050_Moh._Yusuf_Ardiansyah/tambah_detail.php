<?php
session_start();
require_once 'koneksi.php';

$sql_barang = "SELECT id, nama_barang, harga FROM barang";
$hasil_barang = mysqli_query($koneksi, $sql_barang);

$sql_transaksi = "SELECT id, keterangan FROM transaksi ORDER BY id DESC";
$hasil_transaksi = mysqli_query($koneksi, $sql_transaksi);

$selected_transaksi_id = isset($_GET['transaksi_id']) ? (int)$_GET['transaksi_id'] : null;

$detail_existing = [];
if ($selected_transaksi_id) {
    $sql_detail = "SELECT b.nama_barang, td.qty, td.harga 
                   FROM transaksi_detail td
                   JOIN barang b ON td.barang_id = b.id
                   WHERE td.transaksi_id = ?";
    
    $stmt_detail = mysqli_prepare($koneksi, $sql_detail);
    mysqli_stmt_bind_param($stmt_detail, "i", $selected_transaksi_id);
    mysqli_stmt_execute($stmt_detail);
    $hasil_detail = mysqli_stmt_get_result($stmt_detail);
    
    while ($baris = mysqli_fetch_assoc($hasil_detail)) {
        $detail_existing[] = $baris;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Transaksi</title>
</head>
<body>

    <h2>Tambah Detail Transaksi</h2>
    <hr>

    <?php if (isset($_SESSION['notif_sukses'])): ?>
        <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px;">
            <?= $_SESSION['notif_sukses'] ?>
        </div>
        <?php unset($_SESSION['notif_sukses']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['notif_error'])): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
            <?= $_SESSION['notif_error'] ?>
        </div>
        <?php unset($_SESSION['notif_error']); ?>
    <?php endif; ?>

    <form action="proses_tambah_detail.php" method="POST">
        
        <div>
            <label for="barang_id">Pilih Barang</label><br>
            <select id="barang_id" name="barang_id" required>
                <option value="">Pilih Barang</option>
                <?php while ($b = mysqli_fetch_assoc($hasil_barang)): ?>
                    <option value="<?= htmlspecialchars($b['id']) ?>">
                        <?= htmlspecialchars($b['nama_barang']) ?>
                        (Rp <?= number_format($b['harga']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <br>

        <div>
            <label for="transaksi_id">ID Transaksi</label><br>
            <select id="transaksi_id" name="transaksi_id" required>
                <option value="">Pilih ID Transaksi</option>
                <?php while ($t = mysqli_fetch_assoc($hasil_transaksi)): ?>
                    <?php $selected = ($t['id'] == $selected_transaksi_id) ? 'selected' : ''; ?>
                    <option value="<?= htmlspecialchars($t['id']) ?>" <?= $selected ?>>
                        ID: <?= htmlspecialchars($t['id']) ?> (<?= htmlspecialchars($t['keterangan']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <br>

        <div>
            <label for="qty">Quantity</label><br>
            <input type="number" id="qty" name="qty" placeholder="Masukkan jumlah barang" min="1" required>
        </div>
        <br>

        <button type="submit">Tambah Detail Barang</button>
    </form>

    <?php if (!empty($detail_existing)): ?>
        <hr>
        <h3>Barang di Transaksi ID: <?= $selected_transaksi_id ?></h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead> <tr> <th>Nama Barang</th> <th>Qty</th> <th>Sub-Total</th> </tr> </thead>
            <tbody>
                <?php foreach ($detail_existing as $detail): ?>
                <tr>
                    <td><?= htmlspecialchars($detail['nama_barang']) ?></td>
                    <td><?= htmlspecialchars($detail['qty']) ?></td>
                    <td>Rp <?= number_format($detail['harga']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>