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
    <title>Barang</title>
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
        <h1>Barang</h1>
        <a href="tambah_barang.php">Tambah Barang</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Supplier</th>
                <th>Action</th>
            </tr>
            <?php foreach($data_barang as $barang): ?>
                <tr>
                    <td><?php echo $barang['id']; ?></td>
                    <td><?php echo $barang['nama_barang']; ?></td>
                    <td><?php echo $barang['harga']; ?></td>
                    <td><?php echo $barang['stok']; ?></td>
                    <?php 
                        // query untuk ambil nama supplier
                        (int)$supplier_id = $barang['supplier_id'];
                        $query_nama_s = mysqli_query($conn, "SELECT nama FROM supplier WHERE id = $supplier_id");
                        $nama_supplier = mysqli_fetch_all($query_nama_s, MYSQLI_ASSOC)[0]['nama'];
                    ?>
                    <td><?php echo $nama_supplier; ?></td>
                    <td>
                        <a href="edit_barang.php?id=<?php echo $barang['id'] ?>" class="edit">Edit</a>
                        <a href="hapus_barang.php?id=<?php echo $barang['id'] ?>" class="hapus" onclick="return confirm('Apakah anda ingin menghapus barang <?php echo $barang['nama_barang'] ?> ?')" >Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>