<?php
require_once "db.php";
require_once "auth.php"; 

$halaman_aktif = 'supplier'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Tambah Supplier Baru</h2>
        <a href="master_supplier.php" class="btn btn-secondary mb-3">Kembali ke Daftar Supplier</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_supplier.php" method="POST">
                    <input type="hidden" name="action" value="create"> 
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Supplier</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>