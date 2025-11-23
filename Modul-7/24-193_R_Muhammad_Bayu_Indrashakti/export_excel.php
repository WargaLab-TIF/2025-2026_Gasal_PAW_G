<?php
include 'koneksi.php';

$tgl_mulai = $_GET['tgl_mulai'] ?? '2025-11-01';
$tgl_akhir = $_GET['tgl_akhir'] ?? '2025-11-04';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"laporan_penjualan.xls\"");

$sql_laporan = "SELECT 
                    waktu_transaksi, 
                    SUM(total) as total_per_hari
                FROM 
                    transaksi
                WHERE 
                    waktu_transaksi BETWEEN ? AND ?
                GROUP BY 
                    waktu_transaksi
                ORDER BY 
                    waktu_transaksi ASC";

$stmt_laporan = mysqli_prepare($koneksi, $sql_laporan);
mysqli_stmt_bind_param($stmt_laporan, "ss", $tgl_mulai, $tgl_akhir);
mysqli_stmt_execute($stmt_laporan);
$hasil_laporan_harian = mysqli_stmt_get_result($stmt_laporan);

$sql_pendapatan = "SELECT SUM(total) as total_pendapatan
                   FROM transaksi
                   WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt_pendapatan = mysqli_prepare($koneksi, $sql_pendapatan);
mysqli_stmt_bind_param($stmt_pendapatan, "ss", $tgl_mulai, $tgl_akhir);
mysqli_stmt_execute($stmt_pendapatan);
$hasil_pendapatan_query = mysqli_stmt_get_result($stmt_pendapatan);
$row_pendapatan = mysqli_fetch_assoc($hasil_pendapatan_query);
$hasil_total_pendapatan = $row_pendapatan['total_pendapatan'] ?? 0;

$sql_pelanggan = "SELECT COUNT(DISTINCT pelanggan_id) as total_pelanggan
                  FROM transaksi
                  WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt_pelanggan = mysqli_prepare($koneksi, $sql_pelanggan);
mysqli_stmt_bind_param($stmt_pelanggan, "ss", $tgl_mulai, $tgl_akhir);
mysqli_stmt_execute($stmt_pelanggan);
$hasil_pelanggan_query = mysqli_stmt_get_result($stmt_pelanggan);
$row_pelanggan = mysqli_fetch_assoc($hasil_pelanggan_query);
$hasil_total_pelanggan = $row_pelanggan['total_pelanggan'] ?? 0;

mysqli_close($koneksi);
?>
<table border="1">
    <thead>
        <tr>
            <th colspan="3">Rekap Laporan Penjualan <?php echo $tgl_mulai; ?> sampai <?php echo $tgl_akhir; ?></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        if ($hasil_laporan_harian && mysqli_num_rows($hasil_laporan_harian) > 0) {
            while ($row = mysqli_fetch_assoc($hasil_laporan_harian)) {
                $tanggal_obj = date_create($row['waktu_transaksi']);
                $tanggal_format = date_format($tanggal_obj, 'd-M-y'); 
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td>Rp<?php echo number_format($row['total_per_hari'], 0, ',', '.'); ?></td>
            <td><?php echo $tanggal_format; ?></td>
        </tr>
        <?php 
            }
        }
        ?>
    </tbody>
</table>

<br>

<table border="1">
    <thead>
        <tr>
            <th>Jumlah Pelanggan</th>
            <th>Jumlah Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $hasil_total_pelanggan; ?> Orang</td>
            <td>Rp<?php echo number_format($hasil_total_pendapatan, 0, ',', '.'); ?></td>
        </tr>
    </tbody>
</table>