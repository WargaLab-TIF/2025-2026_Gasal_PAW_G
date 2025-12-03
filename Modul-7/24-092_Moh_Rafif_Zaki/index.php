<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);
$barang = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama_supplier = [];
foreach ($barang as $b) {
    $id_supplier = $b['supplier_id'];
    $query = "SELECT nama,id FROM supplier WHERE id = $id_supplier";
    $result = mysqli_query($conn, $query);
    $nama = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $nama_supplier[$id_supplier] =
        [
            'Nama' => $nama[0]['nama'],
            'ID' => $nama[0]['id']
        ];
}


$query = "SELECT * FROM transaksi";
$result = mysqli_query($conn, $query);
$transaksi = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama_pelanggan = [];
foreach ($transaksi as $nama) {
    $id_pelanggan = $nama['pelanggan_id'];
    $query = "SELECT nama FROM pelanggan WHERE id = '$id_pelanggan'";
    $result = mysqli_query($conn, $query);
    $nama = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $nama_pelanggan[$id_pelanggan] = $nama[0]['nama'];
}


$query = "SELECT * FROM transaksi_detail";
$result = mysqli_query($conn, $query);
$transaksi_detail = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nama_barang = [];
foreach ($transaksi_detail as $nama) {
    $id_barang = $nama['barang_id'];
    $query = "SELECT nama_barang FROM barang WHERE id = '$id_barang'";
    $result = mysqli_query($conn, $query);
    $nama = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $nama_barang[$id_barang] = $nama[0]['nama_barang'];
}

if (isset($_POST['tambahTr'])) {
    header('location:../24-092_Moh_Rafif_Zaki_6/transaksi.php');
}

if (isset($_POST['tambahTrd'])) {
    header('location:../24-092_Moh_Rafif_Zaki_6/transaksi_detail.php');
}

if (isset($_POST['laporan'])) {
    header('location:report_transaksi.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Detail</title>
    <style>
        .container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        table {
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
        }

        th {
            background-color: lightcyan;
            border-radius: 10px;
        }

        td:hover {
            background-color: grey;
            border-radius: 10px;
        }

        h1 {
            background-color: lightcyan;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }

        h2 {
            background-color: lightcyan;
            padding: 10px;
            border-radius: 10px;
        }

        .barang {
            width: 725px;
        }

        .delete {
            background-color: red;
            color: black;
            text-decoration: none;
            padding: 7px;
            border-radius: 10px;
        }

        .delete:hover {
            background-color: black;
            color: red;
            text-decoration: none;
            padding: 7px;
            border-radius: 10px;
        }

        .tambahTr {
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .tambahTr:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }

        .tambahTrd {
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .tambahTrd:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }

        .laporan {
            margin-bottom: 10px;
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .laporan:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <h1>Pengelolaan Master Detail</h1>
    <div class="container">
        <div class="table2">
            <h2>Transaksi</h2>
            <form action="index.php" method="post">
                <button type="submit" name="laporan" class="laporan">Lihat Laporan Penjualan</button>
            </form>
            <table border="0" cellpadding="15px" cellspacing="5px">
                <tr>
                    <th>ID</th>
                    <th>Waktu Transaksi</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Nama Pelanggan</th>
                </tr>
                <?php foreach ($transaksi as $b): ?>
                    <?php //var_dump($b)
                    ?>
                    <tr>
                        <td><?= $b['id'] ?></td>
                        <td><?= $b['waktu_transaksi'] ?></td>
                        <td><?= $b['keterangan'] ?></td>
                        <td><?= $b['total'] ?></td>
                        <td><?= $nama_pelanggan[$b['pelanggan_id']] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="table3">

            <h2>Transaksi Detail</h2>
            <table border="0" cellpadding="15px" cellspacing="5px">
                <tr>
                    <th>Transaksi ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                </tr>
                <?php foreach ($transaksi_detail as $b): ?>
                    <tr>
                        <td><?= $b['transaksi_id'] ?></td>
                        <td><?= $nama_barang[$b['barang_id']] ?></td>
                        <td><?= $b['harga'] ?></td>
                        <td><?= $b['qty'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <br>
    <form method="post">
        <button type="submit" name="tambahTr" class="tambahTr">Tambah Transkasi</button>
        <button type="submit" name="tambahTrd" class="tambahTrd">Tambah Transkasi Detail</button>
    </form>
</body>
</html>