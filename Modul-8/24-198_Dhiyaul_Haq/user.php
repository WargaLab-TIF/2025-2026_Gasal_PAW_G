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
    <title>User</title>
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
            <div class="user"><?php echo $hasil['username'] ?>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
    <div class="content">
        <h1>User</h1>
        <a href="tambahUser.php">Tambah User</a>
        <table>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
            <?php $num = 1; ?>
            <?php foreach($data_user as $d): ?>
                <tr>
                    <td><?php echo $num++ ?></td>
                    <td><?php echo $d['username'] ?></td>
                    <td><?php echo $d['nama'] ?></td>
                    <?php if($d['level'] == "1"): ?>
                        <td><?php echo "Owner" ?></td>    
                    <?php else: ?>
                        <td><?php echo "Kasir" ?></td>    
                    <?php endif; ?>
                    <td>
                        <a href="edit_user.php?id=<?php echo $d['id_user'] ?>" class="edit">Edit</a>
                        <a href="hapus_user.php?id=<?php echo $d['id_user'] ?>" class="hapus" onclick="return confirm('Apakah anda ingin menghapus user <?php echo $d['username'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>