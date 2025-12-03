<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "User tidak ditemukan";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];
    
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $data['password'];

    $update = $pdo->prepare("UPDATE user SET nama=?, alamat=?, hp=?, level=?, password=? WHERE id_user=?");
    $update->execute([$nama, $alamat, $hp, $level, $password, $id]);

    header("Location: user_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 400px; margin: auto; padding: 25px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], input[type="password"], textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #f0ad4e; color: white; border: none; border-radius: 4px; cursor: pointer; float: right; }
        button:hover { background: #ed9c28; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
        .note { font-size: 12px; color: #666; }
    </style>
</head>
<body>

<div class="box">
    <h2>Edit User</h2>
    <a href="user_index.php" class="back">← Kembali</a>
    <hr>

    <form method="post">
        <div>
            <label>Username</label>
            <input type="text" value="<?= htmlspecialchars($data['username']) ?>" disabled>
        </div>
        <div>
            <label>Password <span class="note">(Kosongkan jika tidak ingin mengubah)</span></label>
            <input type="password" name="password">
        </div>
        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>
        <div>
            <label>No. HP</label>
            <input type="text" name="hp" value="<?= htmlspecialchars($data['hp']) ?>" required>
        </div>
        <div>
            <label>Level</label>
            <select name="level">
                <option value="1" <?= $data['level'] == 1 ? 'selected' : '' ?>>Owner</option>
                <option value="2" <?= $data['level'] == 2 ? 'selected' : '' ?>>Kasir</option>
            </select>
        </div>
        <div>
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

</body>
</html>