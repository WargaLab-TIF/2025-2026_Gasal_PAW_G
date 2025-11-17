<?php
require_once 'config.php';

// Ambil data pelanggan untuk dropdown
$query_pelanggan = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan ORDER BY nama_pelanggan ASC";
$result_pelanggan = mysqli_query($conn, $query_pelanggan);

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = mysqli_real_escape_string($conn, $_POST['id_pelanggan']);
    $tanggal_transaksi = mysqli_real_escape_string($conn, $_POST['tanggal_transaksi']);
    $total_pembayaran = mysqli_real_escape_string($conn, $_POST['total_pembayaran']);
    
    $query = "INSERT INTO transaksi (id_pelanggan, tanggal_transaksi, total_pembayaran, status) 
              VALUES ('$id_pelanggan', '$tanggal_transaksi', '$total_pembayaran', 'selesai')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data transaksi berhasil ditambahkan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .content {
            padding: 40px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        .btn-submit {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .btn-cancel {
            background: #e0e0e0;
            color: #333;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>➕ Tambah Transaksi Baru</h1>
            <p>Input Data Transaksi</p>
        </div>
        <div class="content">
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="id_pelanggan">Pilih Pelanggan *</label>
                    <select id="id_pelanggan" name="id_pelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while($pelanggan = mysqli_fetch_assoc($result_pelanggan)): ?>
                            <option value="<?= $pelanggan['id_pelanggan'] ?>">
                                <?= $pelanggan['nama_pelanggan'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi *</label>
                    <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" 
                           value="<?= date('Y-m-d') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="total_pembayaran">Total Pembayaran (Rp) *</label>
                    <input type="number" id="total_pembayaran" name="total_pembayaran" 
                           placeholder="Contoh: 150000" min="0" step="1000" required>
                </div>
                
                <div class="button-group">
                    <button type="submit" class="btn btn-submit">💾 Simpan</button>
                    <a href="index.php" class="btn btn-cancel">❌ Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>