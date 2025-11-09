<?php
include 'db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $waktu = $_POST['waktu'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');
    $pelanggan_id = intval($_POST['pelanggan_id'] ?? 0);

    // server-side validasi
    $today = date('Y-m-d');
    if ($waktu < $today) $errors[] = "Tanggal transaksi tidak boleh kurang dari hari ini ($today).";
    if (strlen($keterangan) < 3) $errors[] = "Keterangan minimal 3 karakter.";
    if ($pelanggan_id <= 0) $errors[] = "Pilih pelanggan.";

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO transaksi (waktu, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)");
        $stmt->bind_param('ssi', $waktu, $keterangan, $pelanggan_id);
        if ($stmt->execute()) {
            header("Location: tambah_detail.php?transaksi_id=".$conn->insert_id);
            exit;
        } else {
            $errors[] = "Gagal menyimpan: " . $conn->error;
        }
    }
}

$pel = $conn->query("SELECT * FROM pelanggan");
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tambah Transaksi</title>
  <style>body{font-family:Arial;margin:20px;}label{display:block;margin-top:8px;}</style>
  <script>
    function validateForm(){
      let waktu = document.getElementById('waktu').value;
      let keterangan = document.getElementById('keterangan').value.trim();
      let today = new Date(); today.setHours(0,0,0,0);
      let sel = new Date(waktu);
      if (sel < today){ alert('Tanggal transaksi tidak boleh sebelum hari ini'); return false; }
      if (keterangan.length < 3){ alert('Keterangan minimal 3 karakter'); return false; }
      return true;
    }
  </script>
</head>
<body>
  <h1>Tambah Transaksi</h1>

  <?php if(!empty($errors)): ?>
    <div style="color:red;margin-bottom:10px;">
      <ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul>
    </div>
  <?php endif; ?>
  <form method="post" onsubmit="return validateForm()">
    <label>Waktu transaksi:
        <input id="waktu" type="date" name="waktu" value="<?php echo date('Y-m-d'); ?>" required>
    </label>

    <label>Keterangan:
        <textarea id="keterangan" name="keterangan" rows="3" required minlength="3"></textarea>
    </label>

    <label>Pelanggan:
        <select name="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while($p = $pel->fetch_assoc()): ?>
                <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nama']); ?></option>
            <?php endwhile; ?>
        </select>
    </label>

    <label>Total Transaksi:
        <input type="number" name="total" value="0" min="0" step="0.01" required>
        <!-- Bisa diatur manual, default tetap 0 -->
    </label>

    <button type="submit">Simpan Transaksi</button>
    <a href="index.php">Kembali</a>
  </form>

</body>
</html>
