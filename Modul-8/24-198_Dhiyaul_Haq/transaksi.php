<?php
    include "auth.php";
    include "fungsi.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Transaksi</title>
</head>
<body>
    <div class="header">
        <div class="left">
            <h1>Sistem Penjualan</h1>
            <a href="admin.php">Home</a>
            <?php if($hasil['level'] == 1): ?>
                <div class="data_master">Data Master
                    <div>
                        <a href="barang.php">Barang</a>
                        <a href="supplier.php">Supplier</a>
                        <a href="pelanggan.php">Pelanggan</a>
                        <a href="user.php">User</a>
                    </div>
                </div>
            <?php endif; ?>
            <a href="transaksi.php">Transaksi</a>
            <a href="laporan.php">Laporan</a>
        </div>
        <div class="right">
            <div clas="user"><?php echo $hasil['username'] ?>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
    <div class="content">
        <div clas="tambah_user">
            <h1>Transaksi</h1>
            <a href="tambah_transaksi.php">Tambah Transaksi</a>
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
                <?php foreach($data_transaksi as $t): ?>
                <tr>
                    <td><?php echo $num++ ?></td>
                    <td><?php echo $t['id'] ?></td>
                    <td><?php echo $t['waktu_transaksi'] ?></td>
                    <?php
                    $idPelanggan = $t['pelanggan_id'];
                    
                    $querys = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = '$idPelanggan'");
                    $hasil = mysqli_fetch_all($querys, MYSQLI_ASSOC)[0];
                    ?>
                    <td><?php echo $hasil['nama'] ?></td>
                    <td><?php echo $t['keterangan'] ?></td>
                    <td><?php echo $t['total'] ?></td>
                    <td>
                        <a href="lihat_transaksi.php?id=<?php echo $t['id'] ?>" class="edit">Lihat Detail</a>
                        <a href="hapus_transaksi.php?id=<?php echo $t['id'] ?>" class="hapus" onclick="return confirm('Apakah anda ingin menghapus transaksi <?php echo $t['id'] ?>?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <h1>Transaksi Detail</h1>
            <a href="tambah_transaksi_detail.php">Tambah Transaksi Detail</a>
            <table>
                <tr>
                    <th>Transaksi ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                </tr>
                <?php foreach($data_transaksi_detail as $td): ?>
                    <tr>
                        <td><?php echo $td['transaksi_id'] ?></td>
                        <?php 
                            $barang_id = (int)$td['barang_id'];
                            $query = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id = $barang_id");
                            $nama_barang = mysqli_fetch_all($query, MYSQLI_ASSOC)[0]['nama_barang'];
                        ?>
                        <td><?php echo $nama_barang ?></td>
                        <td><?php echo $td['harga'] ?></td>
                        <td><?php echo $td['qty'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>