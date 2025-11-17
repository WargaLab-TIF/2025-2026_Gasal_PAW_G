<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Transaksi</title>
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
        <h2>Tambah Detail Transaksi</h2>
        
        <form action="proses_tambah_detail.php" method="POST">
            
            <div class="form-group">
                <label for="barang_id">Pilih Barang</label>
                <select id="barang_id" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    <?php
                    $sql_barang = "SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang";
                    $result_barang = $koneksi->query($sql_barang);
                    while($row = $result_barang->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nama_barang']) . " (Rp " . number_format($row['harga']) . ")</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="transaksi_id">ID Transaksi</label>
                <select id="transaksi_id" name="transaksi_id" required>
                    <option value="">Pilih ID Transaksi</option>
                    <?php
                    $sql_transaksi = "SELECT id, keterangan FROM transaksi ORDER BY id DESC";
                    $result_transaksi = $koneksi->query($sql_transaksi);
                    while($row = $result_transaksi->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>ID: " . $row['id'] . " (" . htmlspecialchars($row['keterangan']) . ")</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" id="qty" name="qty" placeholder="Masukkan jumlah barang" min="1" required>
            </div>
            
            <div class="form-group">
                <button type="submit">Tambah Detail Transaksi</button>
            </div>
        </form>
        <a href="index.php" class="link-kembali">Kembali ke Index</a>
    </div>
    <?php $koneksi->close(); ?>
</body>
</html>