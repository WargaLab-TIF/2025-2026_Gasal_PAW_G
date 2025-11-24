<?php
include '../auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Laporan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 450px; margin: auto; padding: 25px; border-radius: 10px; text-align: center; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; }
        a.menu { display: block; padding: 12px; background: #5cb85c; color: white; text-decoration: none; border-radius: 6px; margin: 8px 0; }
        a.menu:hover { background: #449d44; }
        .blue { background: #007bff; }
        .blue:hover { background: #0056b3; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Menu Laporan</h2>

    <a href="laporan_pdf.php" class="menu" target="_blank">Cetak Semua Transaksi (PDF)</a>
    <a href="report_transaksi.php" class="menu blue">Laporan Filter Tanggal & Grafik</a>
    
    <a href="../home.php" class="back">← Kembali ke Home</a>
</div>

</body>
</html>