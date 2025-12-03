<?php include 'koneksi.php';?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjualan XYZ - Data Transaksi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Penjualan XYZ</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Barang</a></li>
                <li class="nav-item active"><a class="nav-link" href="index.php">Transaksi</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Data Master Transaksi
            </div>
            <div class="card-body">
                <a href="report_transaksi.php" class="btn btn-primary mb-3">Lihat Laporan Penjualan</a>
                <a href="#" class="btn btn-success mb-3">Tambah Transaksi</a>

                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM transaksi ORDER BY id_transaksi ASC";
                        $result = $mysqli->query($sql);
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['id_transaksi']; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($row['waktu_transaksi'])); ?></td>
                                <td><?php echo $row['nama_pelanggan']; ?></td>
                                <td><?php echo $row['keterangan']; ?></td>
                                <td>Rp<?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm">Lihat Detail</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>