<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }

$error=''; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $barang_id = (int)$_POST['barang_id'];
    $transaksi_id = (int)$_POST['transaksi_id'];
    $qty = (int)$_POST['qty'];
    if($qty <= 0) $error='Quantity harus > 0';
    elseif(empty($barang_id) || empty($transaksi_id)) $error='Pilih barang dan transaksi';
    else {
        $check = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id=$transaksi_id AND barang_id=$barang_id");
        if(mysqli_num_rows($check)>0){ $error='Barang sudah ditambahkan pada transaksi'; }
        else {
            $b = mysqli_query($conn, "SELECT harga, stok FROM barang WHERE id=$barang_id"); $b = mysqli_fetch_assoc($b);
            if(!$b){ $error='Barang tidak ditemukan'; }
            else {
                $harga_satuan = $b['harga'];
                $total_harga = $harga_satuan * $qty;
                $ins = mysqli_prepare($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?,?,?,?)");
                mysqli_stmt_bind_param($ins, 'iiii', $transaksi_id, $barang_id, $total_harga, $qty);
                mysqli_stmt_execute($ins);
                // update total transaksi
                mysqli_query($conn, "UPDATE transaksi SET total = (SELECT IFNULL(SUM(harga),0) FROM transaksi_detail WHERE transaksi_id=$transaksi_id) WHERE id=$transaksi_id");
                header('Location: data_master_transaksi.php'); exit;
            }
        }
    }
}

$barang_q = mysqli_query($conn, "SELECT id, nama_barang, harga, stok FROM barang ORDER BY nama_barang");
$transaksi_q = mysqli_query($conn, "SELECT id, waktu_transaksi FROM transaksi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Tambah Detail Transaksi</h2>
    <?php if($error) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>
    <form method="POST">
        <label>Pilih Barang: <select name="barang_id" required>
                <option value=''>-- Pilih --</option>
                <?php while($b=mysqli_fetch_assoc($barang_q)){ echo "<option value='{$b['id']}'>{$b['nama_barang']} - Rp ".number_format($b['harga'],0,',','.')." (Stok: {$b['stok']})</option>"; } ?>
            </select></label><br><br>
        <label>Pilih Transaksi: <select name="transaksi_id" required>
                <option value=''>-- Pilih --</option>
                <?php while($t=mysqli_fetch_assoc($transaksi_q)){ echo "<option value='{$t['id']}'>ID: {$t['id']} ({$t['waktu_transaksi']})</option>"; } ?>
            </select></label><br><br>
        <label>Quantity: <input type="number" name="qty" value="1" min="1" required></label><br><br>
        <button type="submit">Tambah Detail</button>
    </form>
    <a href="data_master_transaksi.php">Kembali</a>
</body>

</html>