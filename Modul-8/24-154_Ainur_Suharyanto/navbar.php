<?php
$level = $_SESSION['level'];
$halaman = basename($_SERVER['PHP_SELF']);
?>
<style>
    .all{
        display: flex;
        gap: 20px;
        margin-left: 20px;
        align-items: center;
        width: 100%;
    }
    .bd{
        display: flex;
        align-items: center;
       
        width: 100%;
    }
    .nm, .tm{
        margin-left: auto;
        margin-right: 10px;
        display: flex;
        align-items: center;
    }

    nav{
        font-family: Arial;
        background-color: #25129fff;
        color: white;
        padding: 10px;
    }
    a{
        text-decoration: none;
        color: white;
        font-weight: bold;
    }
    select{
        border-radius: 5px;
        font-size: 15px;
        border: none;
        font-weight: bold;
        background-color: #25129fff;
        color: white;
    }
    h4{
        width: 200px;
    }
</style>

<nav>
    <div class="bd">

        <h4>Sistem Penjualan</h4>

        <div class="all">
        <?php if ($level == 1) { ?>
            
            <a href="/24-154_Ainur_Suharyanto/index.php">Home</a>

            <select onchange="location=this.value;">
                <option value="" disabled 
                    <?= ($halaman != '/24-154_Ainur_Suharyanto/data_barang.php' && $halaman != '/24-154_Ainur_Suharyanto/data_supplier.php' && $halaman != '/24-154_Ainur_Suharyanto/data_pelanggan.php' && $halaman != '/24-154_Ainur_Suharyanto/data_user.php') ? 'selected' : ''; ?>>
                    Data Master
                </option>

                <option value="/24-154_Ainur_Suharyanto/data_barang.php" <?= ($halaman == '/24-154_Ainur_Suharyanto/data_barang.php') ? 'selected' : ''; ?>>Data Barang</option>
                <option value="/24-154_Ainur_Suharyanto/data_supplier.php" <?= ($halaman == '/24-154_Ainur_Suharyanto/data_supplier.php') ? 'selected' : ''; ?>>Data Supplier</option>
                <option value="/24-154_Ainur_Suharyanto/data_pelanggan.php" <?= ($halaman == '/24-154_Ainur_Suharyanto/data_pelanggan.php') ? 'selected' : ''; ?>>Data Pelanggan</option>
                <option value="/24-154_Ainur_Suharyanto/data_user.php" <?= ($halaman == '/24-154_Ainur_Suharyanto/data_user.php') ? 'selected' : ''; ?>>Data User</option>
            </select>

            <a href="/24-154_Ainur_Suharyanto/transaksi/transaksi.php">Transaksi</a>
            <a href="/24-154_Ainur_Suharyanto/laporan/report_transaksi.php">Laporan</a>

            <div class="nm">
                <select onchange="location=this.value;">
                    <option value=""><?=$_SESSION['nama']?></option>
                    <option value="/24-154_Ainur_Suharyanto/proses/logout.php">Logout</option>
                </select>
            </div>

        <?php } ?>

        <?php if ($level == 2) { ?>

            <a href="/24-154_Ainur_Suharyanto/index.php">Home</a>
            <a href="/24-154_Ainur_Suharyanto/transaksi/transaksi.php">Transaksi</a>
            <a href="/24-154_Ainur_Suharyanto/laporan/report_transaksi.php">Laporan</a>

            <div class="tm">
                <select onchange="location=this.value;">
                    <option value=""><?=$_SESSION['nama']?></option>
                    <option value="/24-154_Ainur_Suharyanto/proses/logout.php">Logout</option>
                </select>
            </div>

        <?php } ?>
        </div>

    </div>
</nav>
