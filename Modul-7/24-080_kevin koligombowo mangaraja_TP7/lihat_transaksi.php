<?php
include 'koneksi.php';

if (!isset($_GET['pelanggan_id'])) {
    echo "<script>
            alert('ID pelanggan tidak ditemukan!');
            window.location.href='data_transaksi.php';
          </script>";
    exit;
}

$pelanggan_id = intval($_GET['pelanggan_id']);

// Ambil nama pelanggan
$p = $conn->query("SELECT nama FROM pelanggan WHERE id = $pelanggan_id");

if ($p->num_rows == 0) {
    echo "<script>
            alert('Pelanggan tidak ditemukan!');
            window.location.href='data_transaksi.php';
          </script>";
    exit;
}

$pel = $p->fetch_assoc();

// Ambil semua transaksi pelanggan ini
$q = $conn->query("
    SELECT id, tanggal, keterangan, total
    FROM transaksi1
    WHERE pelanggan_id = $pelanggan_id
    ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Riwayat Transaksi</title>
<style>
    body { font-family: Arial; background: #f0f2f5; }
    .container {
        width: 90%; margin: 20px auto;
        background: white; padding: 20px;
        border-radius: 8px; border:1px solid #ccc;
    }
    h2 {
        background: #1e88e5; color: white;
        padding: 12px; border-radius: 6px;
        margin-top: 0;
    }
    table {
        width: 100%; border-collapse: collapse;
        margin-top: 15px;
        background: white;
    }
    th {
        background: #e3f2fd; padding: 10px;
        border: 1px solid #ccc;
    }
    td {
        padding: 10px; border: 1px solid #ccc;
        text-align: center;
    }
    .btn {
        display: inline-block;
        padding: 10px 15px;
        margin-top: 20px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
    }
</style>
</head>
<body>

<div class="container">

    <h2>Riwayat Transaksi - <?= $pel['nama'] ?></h2>

    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>

        <?php if ($q->num_rows > 0): ?>
            <?php while ($row = $q->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>Rp<?= number_format($row['total'],0,',','.') ?></td>
                <td>
                    <a href="detail_transaksi.php?id=<?= $row['id'] ?>" class="btn">Lihat Detail</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Tidak ada transaksi.</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <a href="data_transaksi.php" class="btn">Kembali</a>

</div>

</body>
</html>
