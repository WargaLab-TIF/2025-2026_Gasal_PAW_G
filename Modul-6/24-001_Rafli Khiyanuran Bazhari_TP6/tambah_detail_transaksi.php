<?php
require_once 'config.php';

$conn = getConnection();
$error = '';
$success = '';

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success = "Detail transaksi berhasil ditambahkan! Total transaksi telah diupdate.";
}

$transaksi_query = "SELECT id, waktu_transaksi FROM transaksi ORDER BY waktu_transaksi DESC";
$transaksi_result = $conn->query($transaksi_query);

$barang_query = "SELECT b.*, s.nama as nama_supplier FROM barang b 
                 LEFT JOIN supplier s ON b.supplier_id = s.id 
                 ORDER BY b.nama_barang";
$barang_result = $conn->query($barang_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    
    $check_query = "SELECT id FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ii", $transaksi_id, $barang_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        $error = "Barang yang dipilih sudah ada dalam detail transaksi ini! Silakan pilih barang lain.";
        $check_stmt->close();
    } else {
        $check_stmt->close();
        
        $barang_query = "SELECT harga_satuan FROM barang WHERE id = ?";
        $barang_stmt = $conn->prepare($barang_query);
        $barang_stmt->bind_param("i", $barang_id);
        $barang_stmt->execute();
        $barang_data = $barang_stmt->get_result()->fetch_assoc();
        $barang_stmt->close();
        
        if ($barang_data) {
            $harga_satuan = $barang_data['harga_satuan'];
            $harga = $harga_satuan * $qty;
            
            $insert_stmt = $conn->prepare("INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("iiid", $transaksi_id, $barang_id, $qty, $harga);
            
            if ($insert_stmt->execute()) {
                $update_total_query = "UPDATE transaksi SET total = (
                    SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = ?
                ) WHERE id = ?";
                $update_stmt = $conn->prepare($update_total_query);
                $update_stmt->bind_param("ii", $transaksi_id, $transaksi_id);
                $update_stmt->execute();
                $update_stmt->close();
                $insert_stmt->close();
                
                header("Location: tambah_detail_transaksi.php?transaksi_id=" . $transaksi_id . "&success=1");
                exit();
            } else {
                $error = "Gagal menambahkan detail transaksi: " . $insert_stmt->error;
                $insert_stmt->close();
            }
        } else {
            $error = "Data barang tidak ditemukan!";
        }
    }
}

$active_transaksi_id = '';
if (isset($_POST['transaksi_id'])) {
    $active_transaksi_id = $_POST['transaksi_id'];
} elseif (isset($_GET['transaksi_id'])) {
    $active_transaksi_id = $_GET['transaksi_id'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
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
        
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
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
    <script>
        function filterBarang() {
            var transaksiId = document.getElementById('transaksi_id').value;
            if (transaksiId) {
                window.location.href = 'tambah_detail_transaksi.php?transaksi_id=' + transaksiId;
            } else {
                window.location.href = 'tambah_detail_transaksi.php';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Kembali ke Beranda</a>
        
        <h1>Tambah Detail Transaksi</h1>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="transaksi_id">ID Transaksi</label>
                <select id="transaksi_id" name="transaksi_id" required onchange="filterBarang()">
                    <option value="">Pilih ID Transaksi</option>
                    <?php 
                    if ($transaksi_result && $transaksi_result->num_rows > 0) {
                        $transaksi_result->data_seek(0);
                        while ($row = $transaksi_result->fetch_assoc()) {
                            $selected = ($active_transaksi_id == $row['id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' $selected>ID: {$row['id']} - " . date('d/m/Y H:i', strtotime($row['waktu_transaksi'])) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="barang_id">Pilih Barang</label>
                <select id="barang_id" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    <?php 
                    if ($barang_result && $barang_result->num_rows > 0) {
                        if ($active_transaksi_id) {
                            // Ambil barang yang sudah digunakan di transaksi ini
                            $used_query = "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?";
                            $used_stmt = $conn->prepare($used_query);
                            $used_stmt->bind_param("i", $active_transaksi_id);
                            $used_stmt->execute();
                            $used_result = $used_stmt->get_result();
                            $used_barang_ids = array();
                            while ($row = $used_result->fetch_assoc()) {
                                $used_barang_ids[] = $row['barang_id'];
                            }
                            $used_stmt->close();
                            
                            // Reset pointer result set
                            $barang_result->data_seek(0);
                            
                            while ($row = $barang_result->fetch_assoc()) {
                                if (!in_array($row['id'], $used_barang_ids)) {
                                    $selected = (isset($_POST['barang_id']) && $_POST['barang_id'] == $row['id']) ? 'selected' : '';
                                    echo "<option value='{$row['id']}' $selected>{$row['kode_barang']} - {$row['nama_barang']} (Rp " . number_format($row['harga_satuan'], 0, ',', '.') . ")</option>";
                                }
                            }
                        } else {
                            while ($row = $barang_result->fetch_assoc()) {
                                $selected = (isset($_POST['barang_id']) && $_POST['barang_id'] == $row['id']) ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>{$row['kode_barang']} - {$row['nama_barang']} (Rp " . number_format($row['harga_satuan'], 0, ',', '.') . ")</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" id="qty" name="qty" 
                       value="<?php echo isset($_POST['qty']) ? htmlspecialchars($_POST['qty']) : ''; ?>" 
                       min="1" required placeholder="Masukkan jumlah barang">
            </div>
            
            <button type="submit" class="btn">Tambah Detail Transaksi</button>
        </form>
    </div>
</body>
</html>
<?php
if (isset($conn) && !$conn->connect_error) {
    $conn->close();
}
?>
