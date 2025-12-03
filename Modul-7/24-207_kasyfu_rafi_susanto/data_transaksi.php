<?php
include 'koneksi.php';

$sql = "SELECT 
            transaksi.id, 
            transaksi.waktu_transaksi, 
            pelanggan.nama AS nama_pelanggan, 
            transaksi.keterangan, 
            transaksi.total 
        FROM 
            transaksi 
        JOIN 
            pelanggan ON transaksi.pelanggan_id = pelanggan.id
        ORDER BY 
            transaksi.id ASC";

$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penjualan XYZ</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="data_transaksi.php">Transaksi</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Data Master Transaksi
            </div>
            <div class="card-body">
                <a href="report_transaksi.php" class="btn btn-primary mb-3">Lihat Laporan Penjualan</a>
                <a href="tambah_transaksi.php" class="btn btn-success mb-3">Tambah Transaksi</a>
                <table class="table table-bordered table-striped">
                    <thead class="table-light text-center">
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
                        if ($hasil) {
                            $no = 1; 
                            while ($row = mysqli_fetch_assoc($hasil)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $row['id']; ?></td>
                            <td><?php echo $row['waktu_transaksi']; ?></td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td class="text-end">Rp<?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="detail_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                                <a href="hapus_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            } 
                            mysqli_close($koneksi);
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>