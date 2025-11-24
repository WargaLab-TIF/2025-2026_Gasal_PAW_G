<?php
include '../auth.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 450px; margin: auto; padding: 25px; border-radius: 10px; text-align: center; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; }
        a.menu { display: block; padding: 12px; background: #0057b7; color: white; text-decoration: none; border-radius: 6px; margin: 8px 0; }
        a.menu:hover { background: #004799; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Menu Data Master</h2>

    <a href="barang_index.php" class="menu">Data Barang</a>
    <a href="supplier_index.php" class="menu">Data Supplier</a>
    <a href="pelanggan_index.php" class="menu">Data Pelanggan</a>
    <a href="user_index.php" class="menu">Data User</a>
    
    <a href="../home.php" class="back">← Kembali ke Home</a>
</div>

</body>
</html>