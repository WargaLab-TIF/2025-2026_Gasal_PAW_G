
<?php
include '../auth.php';
require '../koneksi.php';

// ambil semua transaksi + nama pelanggan
$sql = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        ORDER BY t.waktu_transaksi ASC";

$result = mysqli_query($conn, $sql);
$transaksi = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $transaksi[] = $row;
    }
    mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
    <a href="transaksi.php">Penjualan XYZ</a>
    <a href="#" style="opacity:.7">Supplier</a>
    <a href="#" style="opacity:.7">Barang</a>
    <a href="transaksi.php" style="text-decoration:underline">Transaksi</a>
    <span style="margin-left:auto;opacity:.8">Data Master Transaksi</span>
</div>

<div class="wrap">
    <div style="display:flex;justify-content:space-between;align-items:center">
        <h2>Data Master Transaksi</h2>
        <div>
            <a href="report_transaksi.php" class="btn btn-primary">Laporan</a>
            <a href="transaksi_tambah.php" class="btn btn-success">Tambah</a>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th class="right">Total</th>
            <th>Tindakan</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($transaksi)): ?>
            <tr>
                <td colspan="7" style="text-align:center;color:#6b7280;">Belum ada data transaksi</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($transaksi as $t): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($t['id']); ?></td>
                    <td><?php echo htmlspecialchars($t['waktu_transaksi']); ?></td>
                    <td><?php echo htmlspecialchars($t['nama_pelanggan'] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($t['keterangan']); ?></td>
                    <td class="right">Rp<?php echo number_format((int)$t['total'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="transaksi_detail.php?id=<?php echo $t['id']; ?>" class="btn btn-secondary">Detail</a>
                        <a href="transaksi_hapus.php?id=<?php echo $t['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus transaksi ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>


// ambil data pelanggan dan barang untuk dropdown
$pelanggan = [];
$barang = [];

$resP = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama");
if ($resP) {
    while ($row = mysqli_fetch_assoc($resP)) {
        $pelanggan[] = $row;
    }
    mysqli_free_result($resP);
}

$resB = mysqli_query($conn, "SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang");
if ($resB) {
    while ($row = mysqli_fetch_assoc($resB)) {
        $barang[] = $row;
    }
    mysqli_free_result($resB);
}

// proses simpan
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $pelanggan_id = $_POST['pelanggan_id'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    $barang_id = (int)($_POST['barang_id'] ?? 0);
    $qty = (int)($_POST['qty'] ?? 0);

    if ($pelanggan_id === '' || $barang_id <= 0 || $qty <= 0) {
        $error = 'Pelanggan, barang dan qty wajib diisi.';
    } else {
        // ambil harga barang
        $harga = 0;
        $stmtB = mysqli_prepare($conn, 'SELECT harga FROM barang WHERE id = ?');
        mysqli_stmt_bind_param($stmtB, 'i', $barang_id);
        mysqli_stmt_execute($stmtB);
        $resHB = mysqli_stmt_get_result($stmtB);
        if ($row = mysqli_fetch_assoc($resHB)) {
            $harga = (int)$row['harga'];
        }
        mysqli_free_result($resHB);
        mysqli_stmt_close($stmtB);

        if ($harga <= 0) {
            $error = 'Harga barang tidak ditemukan.';
        } else {
            $total = $harga * $qty;

            mysqli_begin_transaction($conn);
            try {
                $stmtT = mysqli_prepare($conn, 'INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)');
                mysqli_stmt_bind_param($stmtT, 'ssis', $tanggal, $keterangan, $total, $pelanggan_id);
                mysqli_stmt_execute($stmtT);
                $transaksi_id = mysqli_insert_id($conn);
                mysqli_stmt_close($stmtT);

                $stmtD = mysqli_prepare($conn, 'INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)');
                mysqli_stmt_bind_param($stmtD, 'iiii', $transaksi_id, $barang_id, $harga, $qty);
                mysqli_stmt_execute($stmtD);
                mysqli_stmt_close($stmtD);

                mysqli_commit($conn);
                header('Location: transaksi.php');
                exit;
            } catch (Exception $e) {
                mysqli_rollback($conn);
                $error = 'Gagal menyimpan transaksi.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
    <a href="transaksi.php">Penjualan XYZ</a>
    <a href="#" style="opacity:.7">Supplier</a>
    <a href="#" style="opacity:.7">Barang</a>
    <a href="transaksi.php" style="text-decoration:underline">Transaksi</a>
    <span style="margin-left:auto;opacity:.8">Tambah Transaksi</span>
</div>

<div class="wrap">
    <div class="header-bar">Form Tambah Transaksi</div>
    <?php if ($error !== ''): ?><div class="msg-error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

    <form method="post">
        <label>Tanggal Transaksi</label>
        <input type="date" name="tanggal" value="<?php echo htmlspecialchars($_POST['tanggal'] ?? date('Y-m-d')); ?>">

        <label>Pelanggan</label>
        <select name="pelanggan_id">
            <option value="">-- Pilih Pelanggan --</option>
            <?php foreach ($pelanggan as $p): ?>
                <option value="<?php echo htmlspecialchars($p['id']); ?>"
                    <?php echo (($_POST['pelanggan_id'] ?? '') == $p['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($p['nama']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Keterangan</label>
        <textarea name="keterangan" rows="3"><?php echo htmlspecialchars($_POST['keterangan'] ?? ''); ?></textarea>

        <label>Barang</label>
        <select name="barang_id">
            <option value="">-- Pilih Barang --</option>
            <?php foreach ($barang as $b): ?>
                <option value="<?php echo (int)$b['id']; ?>"
                    <?php echo ((int)($_POST['barang_id'] ?? 0) === (int)$b['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($b['nama_barang'] . ' - Rp' . number_format((int)$b['harga'], 0, ',', '.')); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Qty</label>
        <input type="number" name="qty" min="1" value="<?php echo htmlspecialchars($_POST['qty'] ?? '1'); ?>">

        <div style="margin-top:12px;display:flex;gap:8px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="transaksi.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
 