<?php
require 'koneksi.php';


$transaksi = null;
$barang_list = null;
$error = '';

//barang
$barang_sql = "SELECT id,nama_barang FROM barang ORDER BY nama_barang ASC";
var_dump($barang_list);
echo "masuk";
if ($sql = mysqli_query($conn, $barang_sql)) {
    $barang_list = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $barang_list[] = $row;
    }
} 
var_dump($barang_list);

//transaksi
$transaksi_sql = "SELECT id   FROM transaksi ORDER BY id ASC";
if ($sql = mysqli_query($conn, $transaksi_sql)) {
    $transaksi_list = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $transaksi_list[] = $row;
    }
} 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        select,
        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }
    </style> -->
</head>

<body>

    <div class="form-container">
        <h2>Tambah Detail Transaksi</h2>
        <form id="detailForm">
            <label for="barang">Pilih Barang</label>
            <select id="barang" name="barang" required>
                <option value=""> -- pilih barang -- </option>
                <?php if (!empty($barang_list)): ?>
                    <?php foreach ($barang_list as $br): ?>
                        <option value="<?= ($br['id']) ?>">
                            
                            <?=  $br['nama_barang'] ?> 
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>Tidak ada data barang</option>
                <?php endif; ?>
            </select>

            <label for="transaksi">ID Transaksi</label>
            <select id="transaksi" name="transaksi" required>
                <option value=""> -- pilih barang -- </option>
                <?php if (!empty($transaksi_list)): ?>
                    <?php foreach ($transaksi_list as $tr): ?>
                        <option value="<?= ($tr['id']) ?>">
                          
                            <?= $tr['id'] ?> (ID: <?= ($tr['id']) ?>)
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>Tidak ada data transaksi</option>
                <?php endif; ?>
            </select>

            <label for="qty">Quantity</label>
            <input type="number" id="qty" name="qty" placeholder="Masukkan jumlah barang" min="1" required>

            <div class="error" id="errorMsg"></div>

            <button type="submit">Tambah Detail Transaksi</button>
        </form>
    </div>
    <!-- 
    <script>
        // Simulasi barang yang sudah dipilih sebelumnya
        const barangSudahDipilih = ["2"]; // Barang B misalnya sudah dipilih sebelumnya

        document.getElementById("detailForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const barang = document.getElementById("barang").value;
            const errorMsg = document.getElementById("errorMsg");

            if (barangSudahDipilih.includes(barang)) {
                errorMsg.textContent = "Barang ini sudah ditambahkan di detail transaksi!";
            } else {
                errorMsg.textContent = "";
                alert("Detail transaksi berhasil ditambahkan!");
                this.reset();
            }
        });
    </script> -->

</body>

</html>