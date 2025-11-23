<?php
require_once "db.php";
require_once "auth.php"; 

if (!isset($_GET['id'])) {
    header("location: master_user.php");
    exit;
}

$id_user = $_GET['id'];

$stmt = $conn->prepare("SELECT id_user, username, nama, alamat, hp, level FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header("location: master_user.php");
    exit;
}

$halaman_aktif = 'user'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2>Edit User: <?php echo htmlspecialchars($user['username']); ?></h2>
        <a href="master_user.php" class="btn btn-secondary mb-3">Kembali ke Daftar User</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="proses_user.php" method="POST">
                    <input type="hidden" name="action" value="update"> 
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id_user']); ?>">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username (Tidak bisa diubah)</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="hp" name="hp" value="<?php echo htmlspecialchars($user['hp']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($user['alamat']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level Akses</label>
                        <select class="form-select" id="level" name="level" required>
                            <option value="1" <?php echo ($user['level'] == 1 ? 'selected' : ''); ?>>1 (Admin)</option>
                            <option value="2" <?php echo ($user['level'] == 2 ? 'selected' : ''); ?>>2 (Kasir)</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>