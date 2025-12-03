<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if($_SESSION['level'] != 1){ echo 'Tidak ada akses'; exit; }

$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $supplier_id = (int)$_POST['supplier_id'];
    $kode = 'BRG-'.str_pad(rand(1,99999),5,'0',STR_PAD_LEFT);

    $q = mysqli_prepare($conn, "INSERT INTO barang (kode, nama_barang, harga, stok, supplier_id) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($q, 'ssiii', $kode, $nama, $harga, $stok, $supplier_id);
    if(mysqli_stmt_execute($q)){
        header('Location: barang_list.php');
        exit;
    } else {
        $error = 'Gagal menyimpan: '.mysqli_error($conn);
    }
}

$sup = mysqli_query($conn, "SELECT id, nama FROM supplier ORDER BY nama");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Tambah Barang</title>
</head>

<body>
    <h2>Tambah Barang</h2>
    <?php if($error) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>
    <form method="POST" action="">
        <label>Nama Barang: <input type="text" name="nama_barang" required></label><br><br>
        <label>Harga: <input type="number" name="harga" required></label><br><br>
        <label>Stok: <input type="number" name="stok" required></label><br><br>
        <label>Supplier:
            <select name="supplier_id" required>
                <option value=''>-- Pilih --</option>
                <?php while($s = mysqli_fetch_assoc($sup)): ?>
                <option value='<?= $s['id'] ?>'><?= htmlspecialchars($s['nama']) ?></option>
                <?php endwhile; ?>
            </select>
        </label><br><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="barang_list.php">Kembali</a>
</body>

</html>