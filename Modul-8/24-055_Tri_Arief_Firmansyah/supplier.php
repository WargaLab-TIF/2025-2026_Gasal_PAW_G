<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$res = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");
?>
<div class="container">
  <div class="header-row">
    <h2>Data Supplier</h2>
    <a class="btn" href="tambah_supp.php">Tambah Supplier</a>
  </div>

  <table>
    <tr><th>ID</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Email</th><th>Aksi</th></tr>
    <?php while($r = mysqli_fetch_assoc($res)): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= htmlspecialchars($r['nama']) ?></td>
      <td><?= htmlspecialchars($r['telp']) ?></td>
      <td><?= htmlspecialchars($r['alamat']) ?></td>
      <td><?= htmlspecialchars($r['email']) ?></td>
      <td class="actions">
        <a href="edit_supp.php?id=<?= $r['id'] ?>">Edit</a> |
        <a href="hapus_supp.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus supplier?')">Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
