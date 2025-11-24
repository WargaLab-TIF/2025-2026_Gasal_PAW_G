<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location:index.php");
}

if(isset($_POST['logout'])){
    session_unset();
    header("location:index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .dashboard input {
            background-color: lightslategrey;
            border: none;
            padding: 10px;
            color: white;
        }

        .dashboard input:hover {
            padding: 10px;
            text-decoration: none;
            background-color: black;
            border-radius: 10px;
            color: lightblue;
        }

        .dashboard {
            display: flex;
            justify-content: start;
            background-color: lightslategrey;
            align-items: center;
            padding: 10px;
            color: white;
        }

        .dashboard h3 {
            margin-right: 10px;
        }

        .dashboard a {
            padding: 10px;
            text-decoration: none;
            color: white;
        }

        .dashboard a:hover {
            padding: 10px;
            text-decoration: none;
            background-color: black;
            border-radius: 10px;
            color: lightblue;
        }

        .kiri {
            display: flex;
            margin-left: auto;
            margin-right: 100px;
        }

        .navbar {
            padding: 10px;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar li {
            position: relative;
            width: 130px;
        }

        .navbar a {
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .dropdown {
            display: none;
            position: absolute;
            background: lightslategrey;
            top: 40px;
            width: 110px;
            border-radius: 10px;
        }

        .dropdown a:hover {
            background-color: black;
            color: lightblue;
            border-radius: 10px;
        }

        .dropdown a {
            padding: 10px;
        }

        .navbar li:hover .dropdown {
            display: block;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h3>Sistem Penjualan</h3>
        <a href="beranda.php">Home</a>
        <?php if ($_SESSION['level'] == 1): ?>
            <div class="navbar">
                <ul>
                    <li><a href="">Data Master🔻</a>
                        <div class="dropdown">
                            <a href="barang.php">Data Barang</a>
                            <a href="supplier.php">Data Supplier</a>
                            <a href="pelanggan.php">Data Pelanggan</a>
                            <a href="user.php">Data User</a>
                        </div>
                </ul>
            </div>
        <?php endif ?>
        <a href="pilihtrans.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
        <div class="kiri">
            <a href=""><?php echo $_SESSION['nama'] ?></a>
            <form action="header.php" method="post">
                <input type="submit" name="logout" value="logout">
            </form>
        </div>
    </div>
</body>

</html>