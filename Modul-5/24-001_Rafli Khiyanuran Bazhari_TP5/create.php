<?php
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'suplier';
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die('Gagal konek database: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $telp = trim($_POST['telp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if ($nama === '') $errors[] = 'Nama wajib diisi';
    if ($telp === '') $errors[] = 'Telp wajib diisi';
    if ($alamat === '') $errors[] = 'Alamat wajib diisi';

    if (!$errors) {
        $stmt = $mysqli->prepare('INSERT INTO suppliers (nama, telp, alamat) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nama, $telp, $alamat);
        $stmt->execute();
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Master Supplier Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3 class="mb-4">Tambah Data Master Supplier Baru</h3>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e): ?>
                <div><?php echo htmlspecialchars($e); ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" class="row g-3" autocomplete="off">
        <div class="col-12">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Telp</label>
            <input type="text" name="telp" class="form-control" placeholder="telp" value="<?php echo htmlspecialchars($_POST['telp'] ?? ''); ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php echo htmlspecialchars($_POST['alamat'] ?? ''); ?>">
        </div>
        <div class="col-12">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="index.php" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>
</body>
</html>


