<?php
include "koneksi.php";
include "cekSession.php";
include "navbar.php";

// Ambil data transaksi + join pelanggan + user
$query = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan_nama, u.nama AS user_nama
    FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
    JOIN user u ON t.user_id = u.id_user
    ORDER BY t.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .header-transaksi {
            background: #28a745;
            color: white;
            padding: 10px;
            border-radius: 6px 6px 0 0;
            font-size: 18px;
        }
        .box {
            background: white;
            padding: 15px;
            border-radius: 0 0 6px 6px;
            border: 1px solid #dcdcdc;
            margin-bottom: 20px;
        }
        .action-btn {
            margin-right: 5px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-transaksi">Manajemen Transaksi</div>

    <div class="box">

        <a href="tambah_transaksi.php" class="btn btn-success mb-3">Tambah Transaksi</a>

        <table class="table table-bordered text-center table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['waktu_transaksi']; ?></td>
                    <td><?= $row['pelanggan_nama']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
                    <td><?= $row['user_nama']; ?></td>
                    <td>
                        <a href="detail_transaksi.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm action-btn">
                            Detail
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>

    </div>
</div>

</body>
</html>