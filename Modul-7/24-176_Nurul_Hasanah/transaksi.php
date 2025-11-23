<?php

include "koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <div class="container">

        <h3 class="mb-4">Data Transaksi</h3>

        <a href="report_transaksi.php" class="btn btn-primary mb-3">Lihat Laporan Penjualan</a>

        <div class="card">
            <div class="card-header">Daftar Transaksi</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>ID Customer</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                    
                        $query = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");

                        if (mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada data transaksi</td></tr>";
                        }

                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?= $data['id_transaksi']; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td><?= $data['customer_id']; ?></td>
                                <td>Rp <?= number_format($data['total'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

</body>
</html>