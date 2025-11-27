<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 150px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 8px 12px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="nav d-flex justify-content-between align-items-center rounded-3 shadow-sm mt-2 w-100">
        <div class="d-flex ">
            <a class="nav-link <?= ($page == "home") ? 'active' : '' ?>" href="home.php">Home</a>
            <div class="dropdown">
                <a href="#">Data Master ▾</a>
                <div class="dropdown-content">
                    <a class="nav-link <?= ($page == "data_barang") ? 'active' : '' ?> " href="data_barang.php">Data barang</a>
                    <a class="nav-link <?= ($page == "data_supplier") ? 'active' : '' ?> " href="data_supplier.php">Data supplier</a>
                    <a class="nav-link <?= ($page == "data_pelanggan") ? 'active' : '' ?> " href="data_pelanggan.php">Data pelanggan</a>
                    <a class="nav-link <?= ($page == "data_user") ? 'active' : '' ?> " href="data_user.php">Data user</a>
                </div>
            </div>
            <a class="nav-link <?= ($page == "transaksi") ? 'active' : '' ?> " href="transaksi.php">Transaksi</a>
            <a class="nav-link <?= ($page == "laporan") ? 'active' : '' ?> " href="laporan.php">Laporan</a>
            <a class="nav-link" href="../../controler/log_auth.php">keluar</a>
        </div>
        <div class="d-flex align-items-center">
            <p class="m-0 pe-3 text-primary"><?= $_SESSION["username"] ?? '' ?></p>
        </div>
    </nav>

</body>

</html>