<?php
require_once 'config.php';
requireLogin();

if (getUserLevel() != 1) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan - Data Master</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <div class="content-box">
            <h1 class="page-title">Data Master</h1>
            
            <div class="info-box">
                <h3>Menu Data Master</h3>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Data Barang</li>
                    <li>Data Kategori</li>
                    <li>Data Supplier</li>
                    <li>Data Customer</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

