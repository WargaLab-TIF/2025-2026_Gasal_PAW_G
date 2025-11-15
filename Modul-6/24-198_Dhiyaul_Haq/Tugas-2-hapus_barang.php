<?php
    include "fungsi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Barang</title>
</head>
<body>
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
                    <a href="hapus_barang.php?id=<?php echo $barang['id'] ?>" onclick="return confirm('Apakah anda ingin menghapus barang ini?')" >Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>