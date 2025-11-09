<?php
include 'db.php';
$err = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama']);
    $harga = intval($_POST['harga']);
    if ($nama === '') $err[] = "Nama wajib diisi.";
    if ($harga <= 0) $err[] = "Harga harus > 0.";
    if (empty($err)){
        $stmt = $conn->prepare("INSERT INTO barang (nama, harga) VALUES (?, ?)");
        $stmt->bind_param('si', $nama, $harga);
        if ($stmt->execute()) header("Location: index.php");
        else $err[] = $conn->error;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Barang</title></head><body>
<h1>Tambah Barang</h1>
<?php if($err) foreach($err as $e) echo "<div style='color:red'>{$e}</div>"; ?>
<form method="post">
  <label>Nama: <input name="nama" required></label><br>
  <label>Harga: <input type="number" name="harga" min="1" required></label><br>
  <button type="submit">Simpan</button> <a href="index.php">Batal</a>
</form>
</body></html>
