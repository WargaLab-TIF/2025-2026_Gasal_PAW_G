<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM user ORDER BY id_user ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 20px; }
        h2 { color: #333; }
        .btn-back { display: inline-block; padding: 8px 14px; background: #0275d8; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px; }
        .btn-back:hover { background: #025aa5; }
        .tambah { background: #5cb85c; }
        .tambah:hover { background: #449d44; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-top: 15px; }
        th { background: #0275d8; color: white; padding: 12px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #e5e5e5; }
        tr:hover { background: #f1f7ff; }
        .btn { padding: 6px 10px; font-size: 13px; text-decoration: none; color: white; border-radius: 4px; }
        .edit { background: #f0ad4e; }
        .delete { background: #d9534f; }
    </style>
</head>
<body>

<h2>Data User</h2>
<a href="data_master.php" class="btn-back">← Kembali ke Data Master</a>
<a href="user_tambah.php" class="btn tambah">Tambah User Baru</a>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Nama Lengkap</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($users as $u): ?>
    <tr>
        <td><?= htmlspecialchars($u['id_user']) ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['nama']) ?></td>
        <td>
            <?php 
                if ($u['level'] == 1) echo "Owner";
                elseif ($u['level'] == 2) echo "Kasir";
                else echo "Staff";
            ?>
        </td>
        <td>
            <a href="user_edit.php?id=<?= $u['id_user'] ?>" class="btn edit">Edit</a>
            <a href="user_hapus.php?id=<?= $u['id_user'] ?>" class="btn delete" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>