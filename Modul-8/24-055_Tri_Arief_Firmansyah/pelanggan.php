<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

$res = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id ASC");
?>

<div class="container">
  <div class="header-row">
    <h2>Data Pelanggan</h2>
    <a class="btn" href="tambah_pelanggan.php">Tambah Pelanggan</a>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Telepon</th>
      <th>Alamat</th>
      <th>Aksi</th>
    </tr>

    <?php while($p = mysqli_fetch_assoc($res)): ?>
    <tr>
      <td><?= $p['id'] ?></td>
      <td><?= htmlspecialchars($p['nama']) ?></td>
      <td><?= $p['jenis_kelamin'] ?></td>
      <td><?= htmlspecialchars($p['telp']) ?></td>
      <td><?= htmlspecialchars($p['alamat']) ?></td>
      <td class="actions">
        <a href="edit_pelanggan.php?id=<?= $p['id'] ?>">Edit</a> |
        <a href="hapus_pelanggan.php?id=<?= $p['id'] ?>" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
