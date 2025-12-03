<?php
require_once __DIR__ . "/../data_base/koneksi/koneksi.php";
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: form_login.php");
    exit();
}

if ($_SESSION['level'] != 1) {
    echo "<div class='alert-danger'>Anda tidak memiliki akses ke halaman ini.</div>";
    exit();
}

$table = $_GET['table'] ?? '';
$allowed_tables = ['barang', 'supplier', 'pelanggan', 'user'];

if (!in_array($table, $allowed_tables)) {
    die("Tabel tidak valid.");
}

$columns = [];
switch ($table) {
    case 'barang':
        $columns = ['id', 'nama_barang', 'harga', 'stok', 'supplier_id'];
        break;
    case 'supplier':
        $columns = ['id', 'nama', 'telp', 'alamat'];
        break;
    case 'pelanggan':
        $columns = ['id', 'nama', 'jenis_kelamin', 'telp', 'alamat'];
        break;
    case 'user':
        $columns = ['id_user', 'username', 'nama', 'level'];
        break;
}

$sql = "SELECT * FROM `$table`";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
if ($table == 'user') {
    foreach ($data as &$row) {
        $row['level'] = ($row['level'] == 1) ? "Admin" : "User Biasa";
    }
}

$page_title = "Data " . ucfirst($table);
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="css/data-master.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Sistem Penjualan</a>
        <ul class="navbar-nav">
            <li><a class="nav-link" href="menegement.php">Home</a></li>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle" href="#">Data Master</a>
                <ul class="dropdown-menu">
                    <li><a href="data_master.php?table=barang">Data Barang</a></li>
                    <li><a href="data_master.php?table=supplier">Data Supplier</a></li>
                    <li><a href="data_master.php?table=pelanggan">Data Pelanggan</a></li>
                    <li><a href="data_master.php?table=user">Data User</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="transaksi.php">Transaksi</a></li>
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
                <h4><?= htmlspecialchars($page_title) ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($columns as $col): ?>
                                    <th><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $col))) ?></th>
                                <?php endforeach; ?>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)): ?>
                                <tr>
                                    <td colspan="<?= count($columns) + 1 ?>" style="text-align: center; padding: 16px;">
                                        Tidak ada data.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data as $row): ?>
                                    <tr>
                                        <?php foreach ($columns as $col): ?>
                                            <td><?= isset($row[$col]) ? htmlspecialchars($row[$col]) : '' ?></td>
                                        <?php endforeach; ?>
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