<?php
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = (int)$_POST['barang_id'];
    $transaksi_id = (int)$_POST['transaksi_id'];
    $qty = (int)$_POST['qty'];
    
    if ($qty <= 0) {
        $error = "Quantity harus lebih dari 0!";
    }
    elseif (empty($barang_id)) {
        $error = "Silakan pilih barang!";
    }
    elseif (empty($transaksi_id)) {
        $error = "Silakan pilih transaksi!";
    }
    else {
        $check_query = "SELECT * FROM transaksi_detail 
                        WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = "Barang ini sudah ditambahkan ke transaksi tersebut! Silakan pilih barang lain.";
        } else {
            $barang_query = "SELECT harga FROM barang WHERE id = $barang_id";
            $barang_result = mysqli_query($conn, $barang_query);
            
            if (mysqli_num_rows($barang_result) > 0) {
                $barang = mysqli_fetch_assoc($barang_result);
                $harga_satuan = $barang['harga'];
                $total_harga = $harga_satuan * $qty;
                
                $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
                          VALUES ($transaksi_id, $barang_id, $total_harga, $qty)";
                
                if (mysqli_query($conn, $query)) {
                    $update_query = "UPDATE transaksi 
                                    SET total = (
                                        SELECT SUM(harga) 
                                        FROM transaksi_detail 
                                        WHERE transaksi_id = $transaksi_id
                                    ) 
                                    WHERE id = $transaksi_id";
                    mysqli_query($conn, $update_query);
                    
                    $success = "Detail transaksi berhasil ditambahkan! Total transaksi telah diperbarui.";
                    $_POST = array();
                } else {
                    $error = "Gagal menambahkan data: " . mysqli_error($conn);
                }
            } else {
                $error = "Barang tidak ditemukan!";
            }
        }
    }
}

$barang_query = "SELECT id, nama_barang, harga, stok FROM barang ORDER BY nama_barang";
$barang_result = mysqli_query($conn, $barang_query);

if (!$barang_result) {
    die("ERROR Query Barang: " . mysqli_error($conn));
}

$transaksi_query = "SELECT transaksi.id, transaksi.waktu_transaksi, transaksi.keterangan, 
                    pelanggan.nama as nama_pelanggan 
                    FROM transaksi 
                    LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
                    ORDER BY transaksi.id DESC";
$transaksi_result = mysqli_query($conn, $transaksi_query);

if (!$transaksi_result) {
    die("ERROR Query Transaksi: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Detail Transaksi</title>
</head>
<body>
    <h1>Tambah Detail Transaksi</h1>
    
    <?php if ($error): ?>
        <p><strong>ERROR:</strong> <?php echo $error; ?></p>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <p><strong>SUCCESS:</strong> <?php echo $success; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="barang_id">Pilih Barang</label></td>
                <td>
                    <select id="barang_id" name="barang_id" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php 
                        mysqli_data_seek($barang_result, 0);
                        while ($barang = mysqli_fetch_assoc($barang_result)): 
                        ?>
                            <option value="<?php echo $barang['id']; ?>"
                                    <?php echo (isset($_POST['barang_id']) && $_POST['barang_id'] == $barang['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($barang['nama_barang']); ?> - Rp <?php echo number_format($barang['harga'], 0, ',', '.'); ?> (Stok: <?php echo $barang['stok']; ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td><label for="transaksi_id">ID Transaksi</label></td>
                <td>
                    <select id="transaksi_id" name="transaksi_id" required>
                        <option value="">-- Pilih ID Transaksi --</option>
                        <?php 
                        mysqli_data_seek($transaksi_result, 0);
                        while ($transaksi = mysqli_fetch_assoc($transaksi_result)): 
                        ?>
                            <option value="<?php echo $transaksi['id']; ?>"
                                    <?php echo (isset($_POST['transaksi_id']) && $_POST['transaksi_id'] == $transaksi['id']) ? 'selected' : ''; ?>>
                                ID: <?php echo $transaksi['id']; ?> - <?php echo htmlspecialchars($transaksi['nama_pelanggan'] ?? 'N/A'); ?> (<?php echo date('d/m/Y', strtotime($transaksi['waktu_transaksi'])); ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td><label for="qty">Quantity</label></td>
                <td>
                    <input type="number" 
                           id="qty" 
                           name="qty" 
                           value="<?php echo isset($_POST['qty']) ? $_POST['qty'] : '1'; ?>"
                           min="1"
                           required>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <br>
                    <a href="index.php">Kembali</a> | 
                    <button type="submit">Tambah Detail Transaksi</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
mysqli_close($conn);
?>