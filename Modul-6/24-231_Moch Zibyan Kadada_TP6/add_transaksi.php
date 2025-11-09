<?php
include 'koneksi.php';
$sql_pelanggan = "SELECT id, nama FROM pelanggan ORDER BY nama";
$query_pelanggan = mysqli_query($koneksi, $sql_pelanggan);

if (!$query_pelanggan) {
    die("Error query pelanggan: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add Data Transaksi (Master)</h2>
        <form action="process_add_transaksi.php" method="POST">
            <label for="date_transaksi">Waktu Transaksi:</label>
            <input type="date" id="date_transaksi" name="date_transaksi" 
                   min="<?php echo date('Y-m-d'); ?>" required>
            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" required minlength="3"></textarea>
            <label for="total">Total:</label>
            <input type="number" id="total" name="total" value="0">
            <label for="id_pelanggan">Pelanggan:</label>
            <select id="id_pelanggan" name="id_pelanggan" required>
                <option value="">Pilih Pelanggan</option>
                <?php
                while ($DATA = mysqli_fetch_assoc($query_pelanggan)) {
                    echo "<option value='" . $DATA['id'] . "'>" . $DATA['nama'] . "</option>";
                }
                ?>
            </select>
            <button type="submit">Add Transaksi</button>
        </form>
    </div>
</body>
</html>