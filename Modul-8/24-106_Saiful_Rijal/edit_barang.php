<?php
require_once "db.php";
require_once "auth.php"; 

if (!isset($_GET['id'])) {
    header("location: master_barang.php");
    exit;
}

$id_barang = $_GET['id'];

$stmt = $conn->prepare("SELECT id, nama_barang, harga, stok, supplier_id FROM barang WHERE id = ?");
$stmt->bind_param("i", $id_barang);
$stmt->execute();
$result = $stmt->get_result();
$barang = $result->fetch_assoc();
$stmt->close();

if (!$barang) {
    header("location: master_barang.php");
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
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Edit Barang: <?php echo htmlspecialchars($barang['nama_barang']); ?></h2>
        <a href="master_barang.php" class="btn btn-secondary mb-3">Kembali ke Daftar Barang</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_barang.php" method="POST">
                    <input type="hidden" name="action" value="update"> 
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($barang['id']); ?>">
                    
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select class="form-select" id="supplier_id" name="supplier_id" required>
                            <?php foreach ($suppliers as $supplier): ?>
                                <option value="<?php echo $supplier['id']; ?>" <?php echo ($supplier['id'] == $barang['supplier_id'] ? 'selected' : ''); ?>>
                                    <?php echo htmlspecialchars($supplier['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($barang['nama_barang']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($barang['harga']); ?>" required min="0">
                    </div>
                    
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="<?php echo htmlspecialchars($barang['stok']); ?>" required min="0">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Barang</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>