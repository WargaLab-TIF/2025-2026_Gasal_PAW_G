<?php 
    include "fungsi.php";
    include "auth.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pelanggan</title>
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
        <h1>Pelanggan</h1>
        <a href="tambah_pelanggan.php">Tambah Pelanggan</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php $num = 1; ?>
            <?php foreach($data_pelanggan as $d): ?>
                <tr>
                    <td><?php echo $num++ ?></td>
                    <td><?php echo $d['nama'] ?></td>
                    <td><?php echo $d['telp'] ?></td>
                    <td><?php echo $d['alamat'] ?></td>
                    <td>
                        <a href="edit_pelanggan.php?id=<?php echo $d['id'] ?>" class="edit">Edit</a>
                        <a href="hapus_pelanggan.php?id=<?php echo $d['id'] ?>" class="hapus" onclick="return confirm('Apakah anda ingin menghapus pelanggan <?php echo $d['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>