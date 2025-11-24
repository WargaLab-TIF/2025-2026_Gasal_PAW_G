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

$sql_supplier = "SELECT id, nama FROM supplier ORDER BY nama ASC";
$result_supplier = mysqli_query($conn, $sql_supplier);
$suppliers = mysqli_fetch_all($result_supplier, MYSQLI_ASSOC);

$halaman_aktif = 'barang'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Tambah Barang Baru</h2>
        <a href="master_barang.php" class="btn btn-secondary mb-3">Kembali ke Daftar Barang</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_barang.php" method="POST">
                    <input type="hidden" name="action" value="create"> 
                    
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select class="form-select" id="supplier_id" name="supplier_id" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?php echo $supplier['id']; ?>"><?php echo htmlspecialchars($supplier['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" required min="0">
                    </div>
                    
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Awal</label>
                        <input type="number" class="form-control" id="stok" name="stok" required min="0">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Barang</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>