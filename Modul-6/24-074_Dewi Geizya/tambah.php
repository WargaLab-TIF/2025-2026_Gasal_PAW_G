<?php
include 'koneksi.php';
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = $_POST['waktu_transaksi'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');
    $pelanggan_id = $_POST['pelanggan_id'] ?? '';
    $total = 0;
    $min_date = date('Y-m-d');

    if ($waktu_transaksi < $min_date)
        $errors[] = "Tanggal tidak boleh sebelum hari ini.";
    if (strlen($keterangan) < 3)
        $errors[] = "Keterangan minimal 3 karakter.";
    if (empty($pelanggan_id))
        $errors[] = "Pilih pelanggan.";

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $waktu_transaksi, $keterangan, $total, $pelanggan_id);
        if ($stmt->execute()) {
            $success = "Data transaksi berhasil disimpan.";
        } else {
            $errors[] = "Gagal menyimpan: " . $stmt->error;
        }
        $stmt->close();
    }
}

$pelanggan = $conn->query("SELECT pelanggan_id, nama_pelanggan FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<style>
body{font-family:Arial;background:#f8f9fa;}
form{width:350px;margin:30px auto;padding:15px;background:#fff;border-radius:8px;}
label{display:block;margin-top:10px;}
input,select,textarea{width:100%;padding:8px;}
button{margin-top:15px;padding:10px;background: #d3d3e2ff;;color:white;border:none;width:100%;}
.error{color:red;} .success{color:green;}
</style>
</head>
<body>
<form method="post">
<h3>Tambah Transaksi</h3>
<?php if($errors): ?><div class="error"><ul><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul></div><?php endif; ?>
<?php if($success): ?><div class="success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<label>Waktu Transaksi</label>
<input type="date" name="waktu_transaksi" min="<?= date('Y-m-d') ?>" required>
<label>Keterangan</label>
<textarea name="keterangan" minlength="3" required></textarea>
<label>Pelanggan</label>
<select name="pelanggan_id" required>
<option value="">-- Pilih Pelanggan --</option>
<?php while($p=$pelanggan->fetch_assoc()): ?>
<option value="<?= $p['pelanggan_id'] ?>"><?= $p['nama_pelanggan'] ?></option>
<?php endwhile; ?>
</select>
<button type="submit">Simpan</button>
</form>
</body>
</html>
