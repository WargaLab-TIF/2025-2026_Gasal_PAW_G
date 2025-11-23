<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user = "SELECT id_user, level FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

if (empty($args) || $args[0]['level'] != '1') {
    header("location: index.php");
    exit;
}

$sql_barang = "SELECT b.id, b.nama_barang, b.harga, b.stok, s.nama as nama_supplier 
               FROM barang b JOIN supplier s ON b.supplier_id = s.id 
               ORDER BY b.id DESC";
$result_barang = mysqli_query($conn, $sql_barang);
$data_barang = mysqli_fetch_all($result_barang, MYSQLI_ASSOC);

$halaman_aktif = 'barang'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Data Barang</h2>
        
        <a href="tambah_barang.php" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Barang Baru
        </a>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Supplier</th>
                        <th>Harga Jual (Harga)</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data_barang as $barang) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($barang['id']); ?></td>
                        <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                        <td><?php echo htmlspecialchars($barang['nama_supplier']); ?></td>
                        
                        <td>Rp <?php echo number_format($barang['harga'], 0, ',', '.'); ?></td> 
                        
                        <td><?php echo htmlspecialchars($barang['stok']); ?></td>
                        <td>
                            <a href="edit_barang.php?id=<?php echo $barang['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="proses_barang.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id_barang" value="<?php echo $barang['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data_barang)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data barang.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>