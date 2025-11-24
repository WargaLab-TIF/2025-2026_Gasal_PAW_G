<?php
include '../cek_session.php'; 
include '../koneksi.php'; 
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id_transaksi = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : null;
if ($action == 'hapus' && $id_transaksi) {
    if ($_SESSION['level'] != 1) {
        header("location: transaksi.php?pesan=akses_ditolak");
        exit();
    }

    $query = "DELETE FROM penjualan WHERE id_penjualan = '$id_transaksi'";
    if (mysqli_query($koneksi, $query)) {
        header("location: transaksi.php?pesan=hapus_sukses");
    } else {
        header("location: transaksi.php?pesan=hapus_gagal&error=" . urlencode(mysqli_error($koneksi)));
    }
    exit();
}

if ($action == 'detail' && $id_transaksi) {
    $query_header = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    $info = mysqli_fetch_assoc($query_header);

    if (!$info) {
        header("Location: transaksi.php?pesan=id_tidak_ditemukan");
        exit;
    }


    $query_detail = mysqli_query($koneksi, "
        SELECT 
            dp.jumlah,
            dp.harga_satuan,
            dp.subtotal,
            b.nama_barang,
            b.satuan
        FROM detail_penjualan dp
        JOIN barang b ON dp.id_barang = b.id_barang
        WHERE dp.id_penjualan = '$id_transaksi'
        ORDER BY dp.id_detail ASC
    ");
    $page_title = "Detail Transaksi";
} 

else {
    $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
    $page_title = "Daftar Transaksi";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body { background: #f2f2f2; }
        .container {
            margin-top: 40px;
            max-width: <?= ($action == 'detail' ? '900px' : '1000px'); ?>;
            background: #fff;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .box-title, .header-section {
            background: #054a91;
            color: white;
            padding: 14px 18px;
            border-radius: 8px 8px 0 0;
            font-size: 20px;
            font-weight: 600;
        }
        .btn-add { background: #218838; color: #fff; }
        .btn-report { background: #0b5ed7; color: #fff; }
        th { background-color: #e9ecef; }
        .table-responsive, .box-body { padding: 20px; }
        .label-field { font-weight: 600; width: 180px; vertical-align: top; }
        .table-info { background-color: #f8f9fa; }
        .table-detail th { background-color: #054a91; color: white; }
    </style>
</head>

<body>
<div class="container">
    <div class="box-title"><?= $page_title; ?></div>
    
    <?php if (isset($_GET['pesan'])): ?>
        <div class="p-3">
            <?php if ($_GET['pesan'] == 'hapus_sukses'): ?>
                <div class="alert alert-success">Transaksi berhasil dihapus.</div>
            <?php elseif ($_GET['pesan'] == 'hapus_gagal'): ?>
                <div class="alert alert-danger">Gagal menghapus transaksi. Error: <?= htmlspecialchars($_GET['error'] ?? 'Tidak diketahui'); ?></div>
            <?php elseif ($_GET['pesan'] == 'akses_ditolak'): ?>
                <div class="alert alert-warning">Akses ditolak. Anda tidak memiliki hak untuk menghapus transaksi.</div>
            <?php elseif ($_GET['pesan'] == 'id_tidak_ditemukan'): ?>
                <div class="alert alert-danger">ID Transaksi tidak valid atau tidak ditemukan.</div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($action == 'list'): ?>
        <div class="table-responsive">
            <div class="my-3">
                <a href="tambah_data.php" class="btn btn-add">Input Transaksi Baru</a>
                <a href="../home.php" class="btn btn-secondary">← Home</a>
            </div>

            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Nominal (Rp)</th>
                        <th>Kasir</th>
                        <th>Menu</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $no = 1;
                    if (mysqli_num_rows($transaksi) > 0) {
                        while ($row = mysqli_fetch_assoc($transaksi)) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['id_transaksi']); ?></td>
                                <td><?= htmlspecialchars(date('d-m-Y', strtotime($row['tanggal']))); ?></td>
                                <td><?= htmlspecialchars($row['nama_pelanggan'] ?? 'Umum'); ?></td>
                                <td>
                                    <?= "Rp " . number_format($row['total'], 0, ',', '.'); ?>
                                </td>
                                <td><?= htmlspecialchars(str_replace('Penjualan Kasir: ', '', $row['keterangan'])); ?></td>

                                <td>
                                    <a href="transaksi.php?action=detail&id=<?= $row['id_transaksi']; ?>" 
                                       class="btn btn-info btn-sm">
                                        Lihat Detail
                                    </a>

                                    <a href="transaksi.php?action=hapus&id=<?= $row['id_transaksi']; ?>"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ID: <?= $row['id_transaksi']; ?>?')"
                                       class="btn btn-danger btn-sm">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;
                    } else { ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data transaksi yang tersimpan.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($action == 'detail'): ?>
        <div class="box-body">
            <a href="transaksi.php" class="btn btn-secondary mb-4">← Kembali ke Daftar Transaksi</a>

            <h5>Informasi Umum Transaksi</h5>
            <table class="table table-bordered table-info mb-4">
                <tr>
                    <td class="label-field">Kode Transaksi</td>
                    <td><?= htmlspecialchars($info['id_transaksi']); ?></td>
                </tr>
                <tr>
                    <td class="label-field">Tanggal Transaksi</td>
                    <td><?= htmlspecialchars(date('d F Y', strtotime($info['tanggal']))); ?></td>
                </tr>
                <tr>
                    <td class="label-field">Pelanggan</td>
                    <td><?= htmlspecialchars($info['nama_pelanggan'] ?? 'Umum'); ?></td>
                </tr>
                <tr>
                    <td class="label-field">Kasir / User</td>
                    <td><?= htmlspecialchars(str_replace('Penjualan Kasir: ', '', $info['keterangan'])); ?></td>
                </tr>
                <tr>
                    <td class="label-field">Total Nominal</td>
                    <td class="font-weight-bold">Rp <?= number_format($info['total'], 0, ',', '.'); ?></td>
                </tr>
            </table>
            
            <h5 class="mt-4">Item Transaksi (Detail Penjualan)</h5>
            <table class="table table-bordered table-striped table-detail text-center">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Jumlah</th>
                        <th>Subtotal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no_detail = 1;
                    if (mysqli_num_rows($query_detail) > 0) {
                        while ($detail_row = mysqli_fetch_assoc($query_detail)) : ?>
                        <tr>
                            <td><?= $no_detail++; ?></td>
                            <td class="text-left"><?= htmlspecialchars($detail_row['nama_barang']); ?></td>
                            <td><?= htmlspecialchars($detail_row['satuan']); ?></td>
                            <td class="text-right"><?= number_format($detail_row['harga_satuan'], 0, ',', '.'); ?></td>
                            <td><?= $detail_row['jumlah']; ?></td>
                            <td class="text-right font-weight-bold">
                                <?= number_format($detail_row['subtotal'], 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <?php endwhile;
                    } else { ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada detail item untuk transaksi ini.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>