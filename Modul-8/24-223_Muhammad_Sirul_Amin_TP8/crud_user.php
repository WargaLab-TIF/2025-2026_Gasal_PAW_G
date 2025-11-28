<?php
include 'koneksi.php';
include 'header.php';

if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    $_SESSION['login_error'] = "Akses ditolak. Anda harus login sebagai Admin.";
    header("Location: login.php");
    exit();
}

$query_user = "SELECT id_user, username, nama, level FROM user";
$result_user = mysqli_query($koneksi, $query_user);

function getLevelName($level) {
    return $level == 1 ? 'Admin' : 'User Biasa';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Daftar User</h2>
        <p>Anda login sebagai **<?php echo $_SESSION['nama']; ?>** (<?php echo getLevelName($_SESSION['level']); ?>)</p>
        <a href="tambah_user.php" class="btn btn-success float-right mb-3">Tambah User</a>
        
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($result_user)): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo getLevelName($row['level']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="proses_hapus.php?id=<?php echo $row['id_user']; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus user <?php echo $row['username']; ?>?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
</body>
</html>