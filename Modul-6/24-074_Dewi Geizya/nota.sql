<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'nota'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getPelanggan($conn) {
    $result = $conn->query("SELECT pelanggan_id AS id, nama_pelanggan AS nama FROM pelanggan");
    $pelangganList = [];
    while ($row = $result->fetch_assoc()) {
        $pelangganList[] = $row;
    }
    return $pelangganList;
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = $_POST['waktu_transaksi'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');
    $total = $_POST['total'] ?? 0;
    $pelanggan_id = $_POST['pelanggan_id'] ?? '';

    $min_date = '2024-11-01'; 
    if (!$waktu_transaksi) {
        $errors[] = "Waktu transaksi wajib diisi.";
    } else if ($waktu_transaksi < $min_date) {
        $errors[] = "Waktu transaksi tidak boleh sebelum 01 Nov 2024.";
    }

    if (strlen($keterangan) < 3) {
        $errors[] = "Keterangan harus minimal 3 karakter.";
    }

    if (!$pelanggan_id) {
        $errors[] = "Silakan pilih pelanggan.";
    } else {
        // ✅ Cek pelanggan_id berdasarkan nama kolom di database
        $sqlCek = $conn->prepare("SELECT COUNT(*) FROM pelanggan WHERE pelanggan_id = ?");
        $sqlCek->bind_param("i", $pelanggan_id);
        $sqlCek->execute();
        $sqlCek->bind_result($count);
        $sqlCek->fetch();
        $sqlCek->close();

        if ($count == 0) {
            $errors[] = "Pelanggan tidak valid.";
        }
    }

    if (!is_numeric($total)) {
        $total = 0;
    }

    if (empty($errors)) {
        // ✅ Sesuaikan kolom pada tabel transaksi
        $stmt = $conn->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $waktu_transaksi, $keterangan, $total, $pelanggan_id);

        if ($stmt->execute()) {
            $success = "Data transaksi berhasil ditambahkan.";
        } else {
            $errors[] = "Gagal menyimpan data: " . $stmt->error;
        }

        $stmt->close();
    }
}

$pelangganList = getPelanggan($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { width: 350px; margin: 20px auto; padding: 15px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="date"], select, textarea {
            width: 100%; padding: 8px; box-sizing: border-box; margin-top: 5px;
        }
        textarea { resize: vertical; height: 60px; }
        button { margin-top: 15px; padding: 10px; background-color: #007bff; color: white; border: none; width: 100%; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .error { background-color: #f8d7da; color: #721c24; padding: 10px; margin-top: 10px; border-radius: 5px; }
        .success { background-color: #d4edda; color: #155724; padding: 10px; margin-top: 10px; border-radius: 5px; }
    </style>
</head>
<body>

<form method="POST" action="">
    <h3>Tambah Data Transaksi</h3>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <label for="waktu_transaksi">Waktu Transaksi</label>
    <input type="date" id="waktu_transaksi" name="waktu_transaksi" 
           value="<?= htmlspecialchars($_POST['waktu_transaksi'] ?? '') ?>" 
           min="2024-11-01" required>

    <label for="keterangan">Keterangan</label>
    <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi" minlength="3" required><?= htmlspecialchars($_POST['keterangan'] ?? '') ?></textarea>

    <label for="total">Total</label>
    <input type="text" id="total" name="total" value="<?= htmlspecialchars($_POST['total'] ?? '0') ?>">

    <label for="pelanggan_id">Pelanggan</label>
    <select id="pelanggan_id" name="pelanggan_id" required>
        <option value="">Pilih Pelanggan</option>
        <?php foreach ($pelangganList as $pelanggan): ?>
            <option value="<?= $pelanggan['id'] ?>" <?= (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $pelanggan['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($pelanggan['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Tambah Transaksi</button>
</form>

</body>
</html>
