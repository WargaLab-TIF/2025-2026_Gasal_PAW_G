<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
$error=''; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu_transaksi']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $pelanggan_id = (int)$_POST['pelanggan_id'];
    $user_id = $_SESSION['id_user'] ?? 1;
    $today = date('Y-m-d');
    if($waktu < $today){ $error='Waktu transaksi tidak boleh kurang dari hari ini'; }
    elseif(strlen(trim($keterangan))<3){ $error='Keterangan minimal 3 karakter'; }
    else {
        $q = mysqli_prepare($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES (?,?,?,?,?)");
        $zero = 0;
        mysqli_stmt_bind_param($q, 'sssii', $waktu, $keterangan, $zero, $pelanggan_id, $user_id);
        mysqli_stmt_execute($q);
        header('Location: data_master_transaksi.php'); exit;
    }
}
$pel = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama");
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Tambah Transaksi</h2>
    <?php if($error) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>
    <form method="POST">
        <label>Waktu Transaksi: <input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>"
                min="<?= date('Y-m-d') ?>" required></label><br><br>
        <label>Keterangan: <textarea name="keterangan" required minlength="3"></textarea></label><br><br>
        <label>Pelanggan: <select name="pelanggan_id" required>
                <option value=''>-- Pilih --</option>
                <?php while($p=mysqli_fetch_assoc($pel)){ echo "<option value='{$p['id']}'>{$p['nama']}</option>"; } ?>
            </select></label><br><br>
        <button type="submit">Tambah Transaksi</button>
    </form>
    <a href="data_master_transaksi.php">Kembali</a>
</body>

</html>