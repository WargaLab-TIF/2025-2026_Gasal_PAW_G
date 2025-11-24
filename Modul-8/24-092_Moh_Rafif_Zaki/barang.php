<?php
include "header.php";
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
    header('location:transaksi.php');
}

if (isset($_POST['tambahTrd'])) {
    header('location:transaksi_detail.php');
}

if (isset($_POST['tambah'])) {
    header('location:./crud/barang/tbbarang.php');
}


if (isset($_POST['tampil'])) {
    $_SESSION['tampil_transaksi'] = false;
}
if (isset($_POST['tutup'])) {
    $_SESSION['tampil_transaksi'] = true;
}

$tampil = $_SESSION['tampil_transaksi'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Detail</title>
    <style>
        <?php if ($tampil): ?>.container {
            display: none;
            justify-content: flex-start;
            gap: 10px;
        }

        <?php else: ?>.container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        <?php endif ?>
        table {
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            padding: 15px;
        }

        th {
            background-color: lightgray;
            border-radius: 10px;
        }

        td:hover {
            background-color: grey;
            border-radius: 10px;
        }

        .barang {
            width: auto;
            margin: 0;
            padding: 10px;
            background-color: grey;
            color: white;
            text-align: center;
        }

        .transaksi {
            width: auto;
            padding: 10px;
            background-color: grey;
            color: white;
            text-align: center;
            border-radius: 10px;
        }

        .transaksi_td {
            width: auto;
            padding: 10px;
            background-color: grey;
            color: white;
            text-align: center;
            border-radius: 10px;
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

        .tambah {
            background-color: lightslategray;
            color: white;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 7px;
            border: none;
            border-radius: 10px;
            margin-left: 10px;
        }

        .tambah:hover {
            background-color: black;
            color: lightskyblue;
            margin-bottom: 20px;
            padding: 7px;
            border: none;
            border-radius: 10px;
            margin-left: 10px;
        }

        .edit {
            background-color: lightskyblue;
            text-decoration: none;
            color: black;
            padding: 7px;
            border-radius: 10px;
            border: none;
        }

        .edit:hover {
            background-color: black;
            color: lightskyblue;
            padding: 7px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
        }

        .tampil {
            border: 0;
            background-color: lightslategray;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-top: 30px;
            margin-left: 10px;
        }

        .tampil:hover {
            border: 0;
            background-color: black;
            color: lightskyblue;
            padding: 10px;
            border-radius: 10px;
        }

        .tutup {
            border: 0;
            background-color: lightslategray;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-top: 30px;
            margin-left: 10px;
        }

        .tutup:hover {
            border: 0;
            background-color: black;
            color: lightskyblue;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <h2 class="barang">Barang</h2>
    <form action="barang.php" method="post">
        <button type="submit" name="tambah" class="tambah">Tambah barang</button>
    </form>
    <table border="0" cellpadding="15px" cellspacing="15px">
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supllier</th>
            <th>Action</th>
        </tr>
        <?php foreach ($barang as $b): ?>
            <tr>
                <td><?= $nama_supplier[$b['supplier_id']]['ID'] ?></td>
                <td><?= $b['kode_barang'] ?></td>
                <td><?= $b['nama_barang'] ?></td>
                <td><?= $b['harga'] ?></td>
                <td><?= $b['stok'] ?></td>
                <td><?= $nama_supplier[$b['supplier_id']]['Nama'] ?></td>
                <td>
                    <a href="./crud/barang/edbarang.php?id=<?= $b['id'] ?>" class="edit">Edit</a>
                    <a href="./crud/barang/delbarang.php?id=<?= $b['id'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="delete">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="barang.php" method="post">
        <button type="submit" name="tampil" class="tampil">Tampilkan Transaksi</button>
        <button type="submit" name="tutup" class="tutup">Tutup Transaksi</button>
    </form>
    <div class="container">
        <div class="table2">
            <h2 class="transaksi">Transaksi</h2>
            <table border="0" cellpadding="15px" cellspacing="15px">
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

            <h2 class="transaksi_td">Transaksi Detail</h2>
            <table border="0" cellpadding="15px" cellspacing="15px">
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
</body>

</html>