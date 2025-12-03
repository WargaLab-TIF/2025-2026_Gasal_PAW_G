<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Transaksi</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 40px;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box; /* Agar padding tidak menambah width */
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-group input[type="date"] {
            padding: 8px 10px; /* Sedikit penyesuaian untuk date */
        }
        .form-group input[readonly] {
            background-color: #e9ecef;
        }
        .form-group button {
            background-color: #007bff;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s ease-in-out;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .link-kembali {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Transaksi</h2>
        
        <form action="proses_tambah_transaksi.php" method="POST">
            <div class="form-group">
                <label for="waktu_transaksi">Waktu Transaksi</label>
                <input type="date" id="waktu_transaksi" name="waktu_transaksi" 
                       min="<?php echo date('Y-m-d'); ?>" 
                       value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3" 
                          placeholder="Masukkan keterangan transaksi" 
                          minlength="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" id="total" name="total" value="0" readonly>
            </div>
            
            <div class="form-group">
                <label for="pelanggan_id">Pelanggan</label>
                <select id="pelanggan_id" name="pelanggan_id" required>
                    <option value="">Pilih Pelanggan</option>
                    <?php
                    $sql_pelanggan = "SELECT id, nama FROM pelanggan ORDER BY nama";
                    $result_pelanggan = $koneksi->query($sql_pelanggan);
                    while($row = $result_pelanggan->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nama']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit">Tambah Transaksi</button>
            </div>
        </form>
        <a href="index.php" class="link-kembali">Kembali ke Index</a>
    </div>
</body>
</html>