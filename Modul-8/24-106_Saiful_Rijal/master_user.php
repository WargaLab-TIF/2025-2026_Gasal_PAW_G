<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user_list = "SELECT id_user, username, nama, hp, level FROM user ORDER BY id_user DESC";
$result_list = mysqli_query($conn, $sql_user_list);
$data_user = mysqli_fetch_all($result_list, MYSQLI_ASSOC);

$halaman_aktif = 'user'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Data User</h2>
        
        <a href="tambah_user.php" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah User Baru
        </a>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>HP</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data_user as $user) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['nama']); ?></td>
                        <td><?php echo htmlspecialchars($user['hp']); ?></td>
                        <td><?php echo htmlspecialchars($user['level'] == 1 ? 'Admin' : 'Kasir'); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id_user']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="proses_user.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>