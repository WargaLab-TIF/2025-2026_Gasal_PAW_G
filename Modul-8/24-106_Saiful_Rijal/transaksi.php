<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user = "SELECT id_user, level FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

if (empty($args)) {
    header("location: index.php");
    exit;
}

$sql_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama as nama_pelanggan 
                  FROM transaksi t
                  JOIN pelanggan p ON t.pelanggan_id = p.id
                  ORDER BY t.waktu_transaksi DESC, t.id DESC";
$result_transaksi = mysqli_query($conn, $sql_transaksi);
$data_transaksi = mysqli_fetch_all($result_transaksi, MYSQLI_ASSOC);

$halaman_aktif = 'transaksi'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Master Transaksi</h2>
            <div>
                <a href="laporan.php" class="btn btn-primary me-2">Lihat Laporan Penjualan</a>
                <a href="transaksi_baru.php" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Transaksi
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
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
                    <?php $no = 1; ?>
                    <?php if (empty($data_transaksi)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data transaksi.</td>
                    </tr>
                    <?php endif; ?>
                    <?php foreach ($data_transaksi as $transaksi) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($transaksi['id']); ?></td>
                        <td><?php echo htmlspecialchars($transaksi['waktu_transaksi']); ?></td>
                        <td><?php echo htmlspecialchars($transaksi['nama_pelanggan']); ?></td>
                        <td><?php echo htmlspecialchars($transaksi['keterangan']); ?></td>
                        <td>Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="detail_transaksi.php?id=<?php echo $transaksi['id']; ?>" class="btn btn-sm btn-info text-white">Lihat Detail</a>
                            
                            <form action="proses_transaksi.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?php echo $transaksi['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus transaksi ini? Semua detail juga akan hilang.');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>