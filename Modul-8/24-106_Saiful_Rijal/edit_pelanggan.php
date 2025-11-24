<?php
require_once "db.php";
require_once "auth.php"; 

if (!isset($_GET['id'])) {
    header("location: master_pelanggan.php");
    exit;
}

$id_pelanggan = $_GET['id'];

$stmt = $conn->prepare("SELECT id, nama, jenis_kelamin, telp, alamat FROM pelanggan WHERE id = ?");
$stmt->bind_param("s", $id_pelanggan);
$stmt->execute();
$result = $stmt->get_result();
$pelanggan = $result->fetch_assoc();
$stmt->close();

if (!$pelanggan) {
    header("location: master_pelanggan.php");
    exit;
}

$halaman_aktif = 'pelanggan'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Edit Pelanggan: <?php echo htmlspecialchars($pelanggan['nama']); ?></h2>
        <a href="master_pelanggan.php" class="btn btn-secondary mb-3">Kembali ke Daftar Pelanggan</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_pelanggan.php" method="POST">
                    <input type="hidden" name="action" value="update"> 
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($pelanggan['id']); ?>">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($pelanggan['nama']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="L" <?php echo ($pelanggan['jenis_kelamin'] == 'L' ? 'selected' : ''); ?>>Laki-laki (L)</option>
                            <option value="P" <?php echo ($pelanggan['jenis_kelamin'] == 'P' ? 'selected' : ''); ?>>Perempuan (P)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="<?php echo htmlspecialchars($pelanggan['telp']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($pelanggan['alamat']); ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Pelanggan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>