<?php
if (!isset($_GET['tgl_mulai']) || !isset($_GET['tgl_akhir'])) {
    die("Error: Rentang tanggal tidak ditentukan.");
}

$tgl_mulai = $_GET['tgl_mulai'];
$tgl_akhir = $_GET['tgl_akhir'];
$filename = "laporan_penjualan_" . $tgl_mulai . "_sampai_" . $tgl_akhir . ".xls";

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

include 'koneksi.php';

$tgl_mulai_sql = $tgl_mulai . ' 00:00:00';
$tgl_akhir_sql = $tgl_akhir . ' 23:59:59';

$laporan_harian = [];
$summary = ['total_pendapatan' => 0, 'jumlah_pelanggan' => 0];

$sql_harian = "SELECT 
                   DATE(waktu_transaksi) as tanggal, 
                   SUM(total) as total_harian 
               FROM 
                   transaksi 
               WHERE 
                   waktu_transaksi BETWEEN ? AND ? 
               GROUP BY 
                   DATE(waktu_transaksi) 
               ORDER BY 
                   tanggal ASC";
$stmt_harian = mysqli_prepare($koneksi, $sql_harian);
mysqli_stmt_bind_param($stmt_harian, "ss", $tgl_mulai_sql, $tgl_akhir_sql);
mysqli_stmt_execute($stmt_harian);
$result_harian = mysqli_stmt_get_result($stmt_harian);
while ($row = mysqli_fetch_assoc($result_harian)) {
    $laporan_harian[] = $row;
}
mysqli_stmt_close($stmt_harian);

$sql_summary = "SELECT 
                    SUM(total) as total_pendapatan, 
                    COUNT(DISTINCT pelanggan_id) as jumlah_pelanggan 
                FROM 
                    transaksi 
                WHERE 
                    waktu_transaksi BETWEEN ? AND ?";
$stmt_summary = mysqli_prepare($koneksi, $sql_summary);
mysqli_stmt_bind_param($stmt_summary, "ss", $tgl_mulai_sql, $tgl_akhir_sql);
mysqli_stmt_execute($stmt_summary);
$result_summary = mysqli_stmt_get_result($stmt_summary);
$summary = mysqli_fetch_assoc($result_summary);
mysqli_stmt_close($stmt_summary);

mysqli_close($koneksi);

$judul = "Rekap Laporan Penjualan " . htmlspecialchars($tgl_mulai) . " sampai " . htmlspecialchars($tgl_akhir);
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>laporan_penjualan</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines />
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
    <style>
        body { font-family: Calibri, sans-serif; }
        .rekap-harian, .total-summary {
            border-collapse: collapse;
            border: 1px solid #999;
        }
        .rekap-harian th, .rekap-harian td,
        .total-summary th, .total-summary td {
            border: 1px solid #999;
            padding: 5px;
        }
        .judul-laporan {
            font-size: 11pt;
            font-weight: bold;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <td colspan="3" class="judul-laporan"><?php echo $judul; ?></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>

<table class="rekap-harian">
    <thead>
        <tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($laporan_harian as $row): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td>Rp<?php echo number_format($row['total_harian'], 0, ',', '.'); ?></td>
            <td><?php echo date('d-M-y', strtotime($row['tanggal'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>

<table class="total-summary">
    <thead>
        <tr>
            <th>Jumlah Pelanggan</th>
            <th>Jumlah Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo htmlspecialchars($summary['jumlah_pelanggan']); ?> Orang</td>
            <td>Rp<?php echo number_format($summary['total_pendapatan'], 0, ',', '.'); ?></td>
        </tr>
    </tbody>
</table>

</body>
</html>
<?php
exit;
?>