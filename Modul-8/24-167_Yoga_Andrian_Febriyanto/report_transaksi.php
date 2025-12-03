<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        .form-laporan {
            margin: 20px 0;
            padding: 15px;
            background-color: #3313ebff;
            border: 1px solid #000000ff;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            
        }
        .form-filter {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-filter label {
            margin-right: 10px;
            font-weight: bold;
        }
        .form-filter input[type="date"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-filter button {
            padding: 5px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-kembali {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
        $koneksi = mysqli_connect("localhost","root","","penjualan") or die(mysqli_error());
    ?>
    <div class="form-laporan">Rekap Laporan Penjualan</div>
    <a href="menegement.php" class="btn-kembali">Kembali</a><br>
    <div class="form-filter">
        <form method="POST" action="laporan_cetak.php">
            <label for="tanggal_awal">Tanggal Awal:</label>
            <input type="date" id="tanggal_awal" name="tanggal_awal" required>
            <label for="tanggal_akhir">Tanggal Akhir:</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" required>
            <button type="submit">Tampilkan</button>
        </form>
    </div>
</body>
</html>
