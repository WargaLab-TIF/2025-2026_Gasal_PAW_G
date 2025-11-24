<?php
require_once "db.php";
require_once "auth.php"; 

$halaman_aktif = 'user'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Tambah User Baru</h2>
        <a href="master_user.php" class="btn btn-secondary mb-3">Kembali ke Daftar User</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_user.php" method="POST">
                    <input type="hidden" name="action" value="create"> 
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="hp" name="hp" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level Akses</label>
                        <select class="form-select" id="level" name="level" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1">1 (Admin)</option>
                            <option value="2">2 (Kasir)</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan User</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>