<?php
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $database = "store";

    $conn = mysqli_connect($server, $user, $pass, $database);

    $query = mysqli_query($conn, "SELECT * FROM transaksi");
    $transaksi = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
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
        <div class="transaksi">
            <h3>Data Master Transaksi</h3>
            <div>
                <a href="report_transaksi.php">Lihat Laporan Penjualan</a>
                <a href="">Tambah Transaksi</a>
            </div>
            <table>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Waktu Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Tindakan</th>
                </tr>
                <?php $num = 1; ?>
                <?php foreach($transaksi as $t): ?>
                <tr>
                    <td><?php echo $num++ ?>1</td>
                    <td><?php echo $t['id'] ?></td>
                    <td><?php echo $t['waktu_transaksi'] ?></td>
                    <?php
                    $idPelanggan = $t['pelanggan_id'];
                    
                    $querys = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $idPelanggan");
                    $hasil = mysqli_fetch_all($querys, MYSQLI_ASSOC)[0];
                    ?>
                    <td><?php echo $hasil['nama'] ?></td>
                    <td><?php echo $t['keterangan'] ?></td>
                    <td><?php echo $t['total'] ?></td>
                    <td>
                        <a href="">Lihat Detail</a>
                        <a href="">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>