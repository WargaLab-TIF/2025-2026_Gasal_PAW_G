<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div>
            <h3>Store</h3>
        </div>
        <div>
            <a href="">Supplier</a>
            <a href="">Barang</a>
            <a href="">Transaksi</a>
        </div>
    </div>
    <div class="content">
        <div class="report">
            <h3>Rekap Laporan Penjualan</h3>
            <div>
                <a href="Tugas-1.php">Kembali</a>
            </div>
            <!-- <form action="Tugas-3.php" method="POST"> -->
            <form action="Tugas-4.php" method="POST">
                <input type="date" name="awal">
                <input type="date" name="akhir">
                <input type="submit" name="submit" value="Tampilkan">
            </form>
        </div>
    </div>
</body>
</html>