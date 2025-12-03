<?php
require_once __DIR__ . "/../data_base/koneksi/koneksi.php";
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: form_login.php");
    exit();
}
$sql = "SELECT * FROM transaksi ORDER BY waktu_transaksi DESC";
$result = $conn->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$username = $_SESSION['username'] ?? 'User';
$level = $_SESSION['level'] ?? 2;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="css/data-master.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Sistem Penjualan</a>
        <ul class="navbar-nav">
            <li><a class="nav-link" href="menegement.php">Home</a></li>

            <?php if ($level == 1): ?>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle" href="#">Data Master</a>
                <ul class="dropdown-menu">
                    <li><a href="data_master.php?table=barang">Data Barang</a></li>
                    <li><a href="data_master.php?table=supplier">Data Supplier</a></li>
                    <li><a href="data_master.php?table=pelanggan">Data Pelanggan</a></li>
                    <li><a href="data_master.php?table=user">Data User</a></li>
                </ul>
            </li>
            <?php endif; ?>

            <li><a class="nav-link active" href="transaksi.php">Transaksi</a></li>
            <li><a class="nav-link" href="report_transaksi.php">Laporan</a></li>
        </ul>

        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#"><?= htmlspecialchars($username) ?></a>
            <ul class="dropdown-menu">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Data Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Waktu Transaksi</th>
                                <th>Keterangan</th>
                                <th>Total</th>
                                <th>Pelanggan ID</th>
                                <th>User ID</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)): ?>
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 16px;">
                                        Tidak ada data transaksi.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                        <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($row['pelanggan_id']) ?></td>
                                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning">Edit</a>
                                            <a href="#" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>