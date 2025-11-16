<?php
require __DIR__ . '/koneksi.php';

$tanggal_awal  = isset($_GET['awal']) ? $_GET['awal'] : date('Y-m-01');
$tanggal_akhir = isset($_GET['akhir']) ? $_GET['akhir'] : date('Y-m-t');

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$sql = "SELECT waktu_transaksi AS tanggal, SUM(total) AS total_harian
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $tanggal_awal, $tanggal_akhir);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$rekap = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rekap[] = $row;
}
mysqli_free_result($result);
mysqli_stmt_close($stmt);

$sql2 = "SELECT COUNT(*) AS jml
         FROM transaksi
         WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt2 = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt2, 'ss', $tanggal_awal, $tanggal_akhir);
mysqli_stmt_execute($stmt2);
$res2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($res2);
$jumlah_pelanggan = (int)$row2['jml'];
mysqli_free_result($res2);
mysqli_stmt_close($stmt2);

$total_pendapatan = 0;
foreach ($rekap as $r) {
    $total_pendapatan += (int)$r['total_harian'];
}
?>
<table border="1" cellpadding="4" cellspacing="0">
    <tr>
        <th colspan="3">Rekap Laporan Penjualan <?php echo htmlspecialchars($tanggal_awal); ?> sampai <?php echo htmlspecialchars($tanggal_akhir); ?></th>
    </tr>
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>
    <?php if (empty($rekap)): ?>
        <tr><td colspan="3">Tidak ada data</td></tr>
    <?php else: ?>
        <?php $no=1; foreach ($rekap as $r): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td>Rp<?php echo number_format((int)$r['total_harian'], 0, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($r['tanggal']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <th>Jumlah Pelanggan</th>
        <th colspan="2">Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?php echo $jumlah_pelanggan; ?> Orang</td>
        <td colspan="2">Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
    </tr>
</table>
