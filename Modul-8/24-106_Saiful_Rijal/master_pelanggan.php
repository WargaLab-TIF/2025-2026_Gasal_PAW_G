<?php
require_once "db.php";
require_once "auth.php"; 

$sql_pelanggan = "SELECT id, nama, jenis_kelamin, telp, alamat FROM pelanggan ORDER BY id DESC";
$result_pelanggan = mysqli_query($conn, $sql_pelanggan);
$data_pelanggan = mysqli_fetch_all($result_pelanggan, MYSQLI_ASSOC);

$halaman_aktif = 'pelanggan'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Data Pelanggan</h2>
        
        <a href="tambah_pelanggan.php" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Pelanggan Baru
        </a>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>J. Kelamin</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data_pelanggan as $pelanggan) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($pelanggan['nama']); ?></td>
                        <td><?php echo htmlspecialchars($pelanggan['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($pelanggan['telp']); ?></td>
                        <td><?php echo htmlspecialchars($pelanggan['alamat']); ?></td>
                        <td>
                            <a href="edit_pelanggan.php?id=<?php echo $pelanggan['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="proses_pelanggan.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $pelanggan['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
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