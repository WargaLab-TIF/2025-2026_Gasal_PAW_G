<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if($_SESSION['level'] != 1){ echo 'Tidak ada akses'; exit; }

if(!isset($_GET['id'])){ header('Location: barang_list.php'); exit; }
$id = (int)$_GET['id'];
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $supplier_id = (int)$_POST['supplier_id'];

    $q = mysqli_prepare($conn, "UPDATE barang SET nama_barang=?, harga=?, stok=?, supplier_id=? WHERE id=?");
    mysqli_stmt_bind_param($q, 'siiii', $nama, $harga, $stok, $supplier_id, $id);
    if(mysqli_stmt_execute($q)){
        header('Location: barang_list.php');
        exit;
    } else {
        $error = 'Gagal update: '.mysqli_error($conn);
    }
}

$res = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id LIMIT 1");
$row = mysqli_fetch_assoc($res);
$sup = mysqli_query($conn, "SELECT id, nama FROM supplier ORDER BY nama");
?>
<!DOCTYPE html><html><head><meta charset='utf-8'><title>Edit Barang</title></head><body>
<h2>Edit Barang</h2>
<?php if($error) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>
<form method="POST" action="">
    <label>Nama Barang: <input type="text" name="nama_barang" value="<?= htmlspecialchars($row['nama_barang']) ?>" required></label><br><br>
    <label>Harga: <input type="number" name="harga" value="<?= $row['harga'] ?>" required></label><br><br>
    <label>Stok: <input type="number" name="stok" value="<?= $row['stok'] ?>" required></label><br><br>
    <label>Supplier:
        <select name="supplier_id" required>
            <?php while($s = mysqli_fetch_assoc($sup)): ?>
                <option value='<?= $s['id'] ?>' <?= $s['id']==$row['supplier_id']? 'selected':'' ?>><?= htmlspecialchars($s['nama']) ?></option>
            <?php endwhile; ?>
        </select>
    </label><br><br>
    <button type="submit">Update</button>
</form>
<a href="barang_list.php">Kembali</a>
</body></html>
