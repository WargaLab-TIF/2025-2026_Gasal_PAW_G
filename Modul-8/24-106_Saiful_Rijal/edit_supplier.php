<?php
require_once "db.php";
require_once "auth.php"; 

if (!isset($_GET['id'])) {
    header("location: master_supplier.php");
    exit;
}

$id_supplier = $_GET['id'];

$stmt = $conn->prepare("SELECT id, nama, telp, alamat FROM supplier WHERE id = ?");
$stmt->bind_param("i", $id_supplier);
$stmt->execute();
$result = $stmt->get_result();
$supplier = $result->fetch_assoc();
$stmt->close();

if (!$supplier) {
    header("location: master_supplier.php");
    exit;
}

$halaman_aktif = 'supplier'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Edit Supplier: <?php echo htmlspecialchars($supplier['nama']); ?></h2>
        <a href="master_supplier.php" class="btn btn-secondary mb-3">Kembali ke Daftar Supplier</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_supplier.php" method="POST">
                    <input type="hidden" name="action" value="update"> 
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($supplier['id']); ?>">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($supplier['nama']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="<?php echo htmlspecialchars($supplier['telp']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($supplier['alamat']); ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Supplier</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>