<?php
include 'db.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $waktu = $_POST['waktu'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');
    $pelanggan_id = intval($_POST['pelanggan_id'] ?? 0);
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
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Data Transaksi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <div class="bg-white shadow-md rounded-xl p-8 w-full max-w-md">
    <h1 class="text-center text-xl font-semibold mb-6">Tambah Data Transaksi</h1>

    <?php if (!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-4">
        <ul class="list-disc ml-5">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" onsubmit="return validateForm()" class="space-y-4">
      <div>
        <label class="block font-medium mb-1">Waktu Transaksi</label>
        <input type="date" id="waktu" name="waktu" required
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
      </div>

      <div>
        <label class="block font-medium mb-1">Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="3" required minlength="3"
                  placeholder="Masukkan keterangan transaksi"
                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
      </div>
      <div>
        <label class="block font-medium mb-1">Total</label>
        <input type="number" name="total" value="0" min="0" step="0.01" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>


      <div>
        <label class="block font-medium mb-1">Pelanggan</label>
        <select name="pelanggan_id" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <option value="">Pilih Pelanggan</option>
          <?php while($p = $pel->fetch_assoc()): ?>
            <option value="<?= $p['id']; ?>"><?= htmlspecialchars($p['nama']); ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
        Tambah Transaksi
      </button>

      <div class="text-center mt-2">
        <a href="index.php" class="text-blue-500 hover:underline text-sm">Kembali ke Beranda</a>
      </div>
    </form>
  </div>

  <script>
    function validateForm() {
      const waktu = document.getElementById('waktu').value;
      const keterangan = document.getElementById('keterangan').value.trim();
      const today = new Date(); today.setHours(0,0,0,0);
      const inputDate = new Date(waktu);
      if (inputDate < today) { alert('Tanggal transaksi tidak boleh sebelum hari ini'); return false; }
      if (keterangan.length < 3) { alert('Keterangan minimal 3 karakter'); return false; }
      return true;
    }
  </script>
</body>
</html>
