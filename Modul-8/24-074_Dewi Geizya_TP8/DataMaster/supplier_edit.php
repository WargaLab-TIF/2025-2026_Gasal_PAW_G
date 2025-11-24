<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM supplier WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = $pdo->prepare("UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?");
    $update->execute([$nama, $telp, $alamat, $id]);

    header("Location: supplier_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 400px; margin: auto; padding: 25px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #f0ad4e; color: white; border: none; border-radius: 4px; cursor: pointer; float: right; }
        button:hover { background: #ed9c28; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Edit Supplier</h2>
    <a href="supplier_index.php" class="back">← Kembali</a>
    <hr>

    <form method="post">
        <div>
            <label>Nama Supplier</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div>
            <label>No. Telepon</label>
            <input type="text" name="telp" value="<?= htmlspecialchars($data['telp']) ?>" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="alamat" rows="3" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>
        <div>
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

</body>
</html>