<?php
    include "fungsi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Detail</title>
</head>
<body>
    <h1>Pengelolaan Master Detail</h1>
    <h3>Barang</h3>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>
        <?php foreach($data_barang as $barang): ?>
            <tr>
                <td><?php echo $barang['id']; ?></td>
                <td><?php echo $barang['kode_barang']; ?></td>
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
                    <a href="hapus_barang_index.php?id=<?php echo $barang['id'] ?>" onclick="return confirm('Apakah anda ingin menghapus barang ini?')" >Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>Transaksi</h3>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Waktu Transaksi</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Nama Pelanggan</th>
        </tr>
        <?php foreach($data_transaksi as $tr): ?>
            <tr>
                <td><?php echo $tr['id'] ?></td>
                <td><?php echo $tr['waktu_transaksi'] ?></td>
                <td><?php echo $tr['keterangan'] ?></td>
                <td><?php echo $tr['total'] ?></td>
                <?php 
                    $pelanggan_id = $tr['pelanggan_id'];
                    $query = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE id = '$pelanggan_id'");
                    $id_pelanggan = mysqli_fetch_all($query, MYSQLI_ASSOC)[0]['nama'];
                ?>
                <td><?php echo $id_pelanggan ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>Transaksi Detail</h3>
    <table border=1>
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
    <a href="Tugas-1-input_transaksi.php">Tambah Transaksi</a>
    <a href="Tugas-1-input_detail_transaksi.php">Tambah Transaksi</a>
</body>
</html>