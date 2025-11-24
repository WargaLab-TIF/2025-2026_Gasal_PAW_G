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
    header("location: login.php"); 
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location: transaksi.php");
    exit;
}
$id_transaksi = (int)$_GET['id'];

$sql_utama = "SELECT t.id, t.waktu_transaksi, t.total, t.keterangan, 
                     p.nama as nama_pelanggan, u.nama as nama_kasir
              FROM transaksi t
              JOIN pelanggan p ON t.pelanggan_id = p.id
              JOIN user u ON t.user_id = u.id_user
              WHERE t.id = ?";
$stmt_utama = $conn->prepare($sql_utama);
$stmt_utama->bind_param("i", $id_transaksi);
$stmt_utama->execute();
$result_utama = $stmt_utama->get_result();
$transaksi = $result_utama->fetch_assoc();
$stmt_utama->close();

if (!$transaksi) {
    header("location: transaksi.php?error=notfound");
    exit;
}

$sql_detail = "SELECT td.harga, td.qty, b.nama_barang
               FROM transaksi_detail td
               JOIN barang b ON td.barang_id = b.id
               WHERE td.transaksi_id = ?";
$stmt_detail = $conn->prepare($sql_detail);
$stmt_detail->bind_param("i", $id_transaksi);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();
$details = $result_detail->fetch_all(MYSQLI_ASSOC);
$stmt_detail->close();

$halaman_aktif = 'transaksi'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #<?php echo $id_transaksi; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <h2 class="mb-4">Detail Transaksi #<?php echo htmlspecialchars($transaksi['id']); ?></h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">Informasi Transaksi</div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td style="width: 30%;"><strong>Tanggal</strong></td>
                                <td>: <?php echo htmlspecialchars($transaksi['waktu_transaksi']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Pelanggan</strong></td>
                                <td>: <?php echo htmlspecialchars($transaksi['nama_pelanggan']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Kasir</strong></td>
                                <td>: <?php echo htmlspecialchars($transaksi['nama_kasir']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>: <?php echo htmlspecialchars($transaksi['keterangan']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-success text-white">Ringkasan Pembayaran</div>
                    <div class="card-body text-center">
                        <h3 class="mt-2">TOTAL</h3>
                        <h1 class="text-success fw-bold">Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?></h1>
                        <p class="text-muted mb-0">(Total ini sudah final)</p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Barang yang Dibeli</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama Barang</th>
                        <th style="width: 20%;">Harga Satuan</th>
                        <th style="width: 10%;">Qty</th>
                        <th style="width: 20%;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (empty($details)) : ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada detail barang tercatat.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($details as $detail) : ?>
                        <?php $sub_total_item = $detail['harga'] * $detail['qty']; ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($detail['nama_barang']); ?></td>
                            <td>Rp <?php echo number_format($detail['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($detail['qty']); ?></td>
                            <td>Rp <?php echo number_format($sub_total_item, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Grand Total</td>
                        <td class="fw-bold">Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <a href="transaksi.php" class="btn btn-secondary mt-3">Kembali ke Daftar Transaksi</a>

    </div>
</body>
</html>