<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if($_SESSION['level'] != 1){ echo 'Tidak ada akses'; exit; }

$res = mysqli_query($conn, "SELECT b.id, b.kode, b.nama_barang, b.harga, b.stok, s.nama as supplier_name FROM barang b LEFT JOIN supplier s ON b.supplier_id = s.id ORDER BY b.id");
?>
<!DOCTYPE html><html><head><meta charset='utf-8'><title>Data Barang</title></head><body>
<h2>Data Barang</h2>
<a href='tambah_barang.php'>+ Tambah Barang</a> | <a href='data_master.php'>Kembali</a>
<table border='1' cellpadding='6' cellspacing='0'>
    <thead><tr><th>ID</th><th>Kode</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['kode']) ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= htmlspecialchars($row['supplier_name'] ?? 'N/A') ?></td>
            <td>
                <a href="edit_barang.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="hapus_barang.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus barang?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</body></html>
