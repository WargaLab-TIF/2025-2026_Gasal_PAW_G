<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Master Supplier</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div class="title">Data Master Supplier</div>
      <a class="btn btn-add" href="tambah.php">Tambah Data</a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Telp</th>
          <th>Alamat</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): $no=1; ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td><?= htmlspecialchars($row['telp']) ?></td>
              <td><?= htmlspecialchars($row['alamat']) ?></td>
              <td>
                <a class="btn btn-edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="btn btn-delete" href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5">Belum ada data</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
