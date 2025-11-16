<?php 
$conn = mysqli_connect("localhost","root","","penjualan");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="report_transaksi.php" class="btn btn-primary">Lihat Laporan Penjualan</a>
<a href="tambah_transaksi.php" class="btn btn-success">Tambah Transaksi</a>

    <table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            
            <th>Keterangan</th>
            <th>Total</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $q = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY waktu_transaksi ASC");
        while($row = mysqli_fetch_assoc($q)){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['waktu_transaksi'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ",", ".") ?></td>
            <td>
                <a href="detail_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                <a href="hapus_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

    
</body>
</html>