<?php
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = mysqli_real_escape_string($conn, $_POST['waktu_transaksi']);
    $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
    $pelanggan_id = mysqli_real_escape_string($conn, $_POST['pelanggan_id']);
    $user_id = 1;
    
    $today = date('Y-m-d');
    if ($waktu_transaksi < $today) {
        $error = "Waktu transaksi tidak boleh kurang dari tanggal hari ini!";
    }
    elseif (strlen($keterangan) < 3) {
        $error = "Keterangan minimal 3 karakter!";
    }
    elseif (empty($pelanggan_id)) {
        $error = "Silakan pilih pelanggan!";
    }
    else {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) 
                  VALUES ('$waktu_transaksi', '$keterangan', 0, '$pelanggan_id', $user_id)";
        
        if (mysqli_query($conn, $query)) {
            $success = "Data transaksi berhasil ditambahkan!";
            $_POST = array();
        } else {
            $error = "Gagal menambahkan data: " . mysqli_error($conn);
        }
    }
}

$pelanggan_query = "SELECT id, nama FROM pelanggan ORDER BY nama";
$pelanggan_result = mysqli_query($conn, $pelanggan_query);

if (!$pelanggan_result) {
    die("ERROR Query Pelanggan: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Transaksi</title>
</head>
<body>
    <h1>Tambah Data Transaksi</h1>
    
    <?php if ($error): ?>
        <p><strong>ERROR:</strong> <?php echo $error; ?></p>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <p><strong>SUCCESS:</strong> <?php echo $success; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="waktu_transaksi">Waktu Transaksi </label></td>
                <td>
                    <input type="date" 
                           id="waktu_transaksi" 
                           name="waktu_transaksi" 
                           value="<?php echo isset($_POST['waktu_transaksi']) ? $_POST['waktu_transaksi'] : date('Y-m-d'); ?>" 
                           min="<?php echo date('Y-m-d'); ?>"
                           required>
                </td>
            </tr>
            
            <tr>
                <td><label for="keterangan">Keterangan</label></td>
                <td>
                    <textarea id="keterangan" 
                              name="keterangan" 
                              rows="4" 
                              cols="40"
                              placeholder="Masukkan keterangan transaksi"
                              minlength="3"
                              required><?php echo isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : ''; ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td><label>Total</label></td>
                <td>
                    <input type="text" value="0" disabled>
                </td>
            </tr>
            
            <tr>
                <td><label for="pelanggan_id">Pelanggan</label></td>
                <td>
                    <select id="pelanggan_id" name="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while ($pelanggan = mysqli_fetch_assoc($pelanggan_result)): ?>
                            <option value="<?php echo $pelanggan['id']; ?>"
                                    <?php echo (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $pelanggan['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($pelanggan['nama']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <br>
                    <a href="index.php">Kembali</a> | 
                    <button type="submit">Tambah Transaksi</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
mysqli_close($conn);
?>