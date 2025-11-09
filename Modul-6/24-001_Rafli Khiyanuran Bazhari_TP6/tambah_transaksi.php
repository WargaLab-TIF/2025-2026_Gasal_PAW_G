<?php
require_once 'config.php';

$conn = getConnection();
$error = '';
$success = '';

$pelanggan_query = "SELECT id, nama FROM pelanggan ORDER BY nama";
$pelanggan_result = $conn->query($pelanggan_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];
    
    $waktu_input = strtotime($waktu_transaksi);
    $waktu_sekarang = strtotime(date('Y-m-d H:i:s'));
    
    if ($waktu_input < $waktu_sekarang) {
        $error = "Waktu transaksi tidak boleh lebih awal dari tanggal saat ini!";
    } elseif (strlen(trim($keterangan)) < 3) {
        $error = "Keterangan minimal harus 3 karakter!";
    } else {
        $waktu_mysql = date('Y-m-d H:i:s', strtotime($waktu_transaksi));
        
        $stmt = $conn->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)");
        $stmt->bind_param("ssi", $waktu_mysql, $keterangan, $pelanggan_id);
        
        if ($stmt->execute()) {
            $success = "Data transaksi berhasil ditambahkan!";
            $_POST = array();
        } else {
            $error = "Gagal menambahkan data transaksi: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        input[type="datetime-local"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        input[type="text"][readonly] {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }
        
        .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
        }
        
        .btn:hover {
            background: #0056b3;
        }
        
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }
        
        .alert-error {
            background-color: #fee;
            color: #c33;
        }
        
        .alert-success {
            background-color: #efe;
            color: #3c3;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            color: #007bff;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Kembali ke Beranda</a>
        
        <h1>Tambah Data Transaksi</h1>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="waktu_transaksi">Waktu Transaksi</label>
                <input type="datetime-local" id="waktu_transaksi" name="waktu_transaksi"
                       value="<?php echo isset($_POST['waktu_transaksi']) ? htmlspecialchars($_POST['waktu_transaksi']) : date('Y-m-d\TH:i'); ?>"
                       required>
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan"
                          placeholder="Masukkan keterangan transaksi"
                          required><?php echo isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" id="total" name="total" value="0" readonly>
            </div>
            
            <div class="form-group">
                <label for="pelanggan_id">Pelanggan</label>
                <select id="pelanggan_id" name="pelanggan_id" required>
                    <option value="">Pilih Pelanggan</option>
                    <?php
                    if ($pelanggan_result && $pelanggan_result->num_rows > 0) {
                        while ($row = $pelanggan_result->fetch_assoc()) {
                            $selected = (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $row['id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>{$row['nama']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="btn">Tambah Transaksi</button>
        </form>
    </div>
</body>
</html>
