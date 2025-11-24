<?php
include '../auth.php';
require '../koneksi.php';

$awal = $_GET['awal'] ?? date('Y-m-01');
$akhir = $_GET['akhir'] ?? date('Y-m-t');

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_$awal-$akhir.xls");

$sql = "SELECT t.id, t.waktu_transaksi, p.nama as pelanggan, t.keterangan, t.total 
        FROM transaksi t
        LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
        WHERE t.waktu_transaksi BETWEEN ? AND ? 
        ORDER BY t.waktu_transaksi ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$awal, $akhir]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
    <tr>
        <th colspan="5" style="background-color: yellow;">LAPORAN PENJUALAN</th>
    </tr>
    <tr>
        <td colspan="5">Periode: <?= $awal ?> s/d <?= $akhir ?></td>
    </tr>
    <tr>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
    </tr>
    
    <?php 
    $total_all = 0;
    foreach ($data as $d): 
        $total_all += $d['total'];
    ?>
    <tr>
        <td><?= $d['id'] ?></td>
        <td><?= $d['waktu_transaksi'] ?></td>
        <td><?= $d['pelanggan'] ?? '-' ?></td>
        <td><?= $d['keterangan'] ?></td>
        <td><?= $d['total'] ?></td>
    </tr>
    <?php endforeach; ?>
    
    <tr>
        <th colspan="4">TOTAL PENDAPATAN</th>
        <th><?= $total_all ?></th>
    </tr>
</table>