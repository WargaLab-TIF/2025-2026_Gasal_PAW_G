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
    <title>Supplier</title>
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
        <h1>Supplier</h1>
        <a href="tambah_supplier.php">Tambah Supplier</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
            <?php foreach($data_supplier as $r): ?>
                <tr>
                    <td><?php echo $r["id"]; ?></td>
                    <td><?php echo $r["nama"]; ?></td>
                    <td><?php echo $r["telp"]; ?></td>
                    <td><?php echo $r["alamat"]; ?></td>
                    <td>
                        <a href="edit_supplier.php?id=<?php echo $r["id"]; ?>" class="edit">Edit</a>
                        <a href="hapus_supplier.php?id=<?php echo $r["id"]; ?>" class="hapus" onclick="return confirm('Apakah anda ingin menghapus supplier <?php echo $r['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>