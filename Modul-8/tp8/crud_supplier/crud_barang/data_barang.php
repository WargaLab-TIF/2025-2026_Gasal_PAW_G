<?php
require_once "../session.php";
deny_if_not_logged_in();
require_level(1);
require "../conn.php";
include "../navbar.php";

$q = $conn->query("
    SELECT barang.*, supplier.nama AS nama_supplier
    FROM barang 
    JOIN supplier ON barang.supplier_id = supplier.id
");
?>
<h2>Data Barang</h2>
<a href="tambah.php">Tambah Barang</a>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th>
    </tr>
    <?php while ($r = $q->fetch_assoc()): ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['nama_barang'] ?></td>
        <td><?= $r['harga'] ?></td>
        <td><?= $r['stok'] ?></td>
        <td><?= $r['nama_supplier'] ?></td>
        <td>
            <a href="edit.php?id=<?= $r['id'] ?>">Edit</a> |
            <a href="hapus.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
