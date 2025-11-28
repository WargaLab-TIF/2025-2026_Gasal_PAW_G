<?php
require 'koneksi.php';

$waktu_transaksi = date('Y-m-d H:i'); //waktu sekarang
$keterangan = '';
$error = '';

$pelanggan_sql = "SELECT id,nama FROM pelanggan ORDER BY nama ASC";

if ($sql = mysqli_query($conn, $pelanggan_sql)) {
    $pelanggan_list = [];   
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelanggan_list[] = $row;
    }
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi Master</title>
    <style>
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
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            margin-top: 10px;
            font-size: 14px;
        }

        input[type="date"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }

        textarea {
            resize: vertical;
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
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Tambah Data Transaksi</h2>

        <?php if (isset($error['db'])): ?>
            <p class="error">Gagal: <?= $error['db'] ?></p>
        <?php endif; ?>

        <form method="POST" action="transaksi_tambah.php">

            <label for="waktu_transaksi">Waktu Transaksi:</label>
            <input type="datetime-local" id="waktu_transaksi" name="waktu_transaksi"
                value="<?= htmlspecialchars(date('Y-m-d\TH:i:s', strtotime($waktu_transaksi))) ?>" required>
            <?php if (isset($error['waktu'])): ?>
                <div class="error"><?= $error['waktu'] ?></div><?php endif; ?>

            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" cols="25"
                required><?= htmlspecialchars($keterangan) ?></textarea>
            <?php if (isset($error['keterangan'])): ?>
                <div class="error"><?= $error['keterangan'] ?></div><?php endif; ?>

            <label for="total">Total</label>
            <input type="number" id="total" name="total" value="0" required> <br>

            <label for="pelanggan">Pelanggan:</label>
            <select id="pelanggan" name="pelanggan" required>
                <option value="" cosl="25">-- Pilih Pelanggan --</option>
                <?php foreach ($pelanggan_list as $pl): ?>
                    <option value="<?= $pl['id'] ?>">
                       
                        <?= ($pl['nama']) ?> (ID: <?= $pl['id'] ?>)
                    </option>
                <?php endforeach; ?>
            </select> <br>

            <button type="button" onclick="window.location.href='transaksi_detail.php'">Tambah Transaksi</button>
        </form>
    </div>
</body>

</html>