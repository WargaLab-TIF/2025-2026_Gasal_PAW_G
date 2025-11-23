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

$sql_supplier = "SELECT id, nama, telp, alamat FROM supplier ORDER BY id DESC";
$result_supplier = mysqli_query($conn, $sql_supplier);
$data_supplier = mysqli_fetch_all($result_supplier, MYSQLI_ASSOC);

$halaman_aktif = 'supplier'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Data Supplier</h2>
        
        <a href="tambah_supplier.php" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Supplier Baru
        </a>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data_supplier as $supplier) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($supplier['id']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['nama']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['telp']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['alamat']); ?></td>
                        <td>
                            <a href="edit_supplier.php?id=<?php echo $supplier['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="proses_supplier.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $supplier['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data_supplier)) : ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data supplier.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>