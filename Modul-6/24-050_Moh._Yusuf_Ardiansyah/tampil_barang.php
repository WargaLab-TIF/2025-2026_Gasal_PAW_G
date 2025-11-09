<?php
session_start();
require_once 'koneksi.php';

$sql = "SELECT id, nama_barang, harga, stok FROM barang";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
</head>
<body>

    <h2>Daftar Data Barang</h2>
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

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($baris = mysqli_fetch_assoc($hasil)): ?>
            <tr>
                <td><?= htmlspecialchars($baris['id']) ?></td>
                <td><?= htmlspecialchars($baris['nama_barang']) ?></td>
                <td><?= number_format($baris['harga']) ?></td>
                <td><?= htmlspecialchars($baris['stok']) ?></td>
                <td>
                    <a href="hapus_barang.php?id=<?= htmlspecialchars($baris['id']) ?>" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>

</body>
</html>