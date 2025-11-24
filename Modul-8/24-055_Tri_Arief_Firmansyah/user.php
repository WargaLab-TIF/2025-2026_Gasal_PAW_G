<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

// hanya owner (level 1) boleh akses
if($_SESSION['level'] != 1){
    echo "<div class='container'>Anda tidak punya akses ke halaman ini</div>";
    exit;
}

$res = mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC");
?>
<div class="container">
  <div class="header-row">
    <h2>Data User</h2>
    <a class="btn" href="tambah_user.php">Tambah User</a>
  </div>

  <table>
    <tr><th>ID</th><th>Username</th><th>Nama</th><th>HP</th><th>Alamat</th><th>Level</th><th>Aksi</th></tr>
    <?php while($r = mysqli_fetch_assoc($res)): ?>
    <tr>
      <td><?= $r['id_user'] ?></td>
      <td><?= htmlspecialchars($r['username']) ?></td>
      <td><?= htmlspecialchars($r['nama']) ?></td>
      <td><?= htmlspecialchars($r['hp']) ?></td>
      <td><?= htmlspecialchars($r['alamat']) ?></td>
      <td><?= $r['level'] ?></td>
      <td class="actions">
        <a href="edit_user.php?id=<?= $r['id_user'] ?>">Edit</a> |
        <a href="hapus_user.php?id=<?= $r['id_user'] ?>" onclick="return confirm('Hapus user?')">Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
