<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user = "SELECT level FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

if (empty($args) || $args[0]['level'] != '1') {
    die("Akses ditolak. Anda tidak memiliki izin untuk melihat laporan.");
}

$tgl_mulai = isset($_GET['dari']) ? $_GET['dari'] : die("Error: Tanggal mulai tidak ditentukan.");
$tgl_akhir = isset($_GET['sampai']) ? $_GET['sampai'] : die("Error: Tanggal akhir tidak ditentukan.");

$filename = "laporan_penjualan_" . $tgl_mulai . "_sampai_" . $tgl_akhir . ".xls";

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

$laporan_harian = [];
$summary = ['total_pendapatan' => 0, 'jumlah_pelanggan' => 0];

$sql_harian = "SELECT 
                    waktu_transaksi as tanggal, 
                    SUM(total) as total_harian 
                FROM 
                    transaksi 
                WHERE 
                    waktu_transaksi BETWEEN ? AND ? 
                GROUP BY 
                    waktu_transaksi 
                ORDER BY 
                    tanggal ASC";
$stmt_harian = $conn->prepare($sql_harian); 
$stmt_harian->bind_param("ss", $tgl_mulai, $tgl_akhir);
$stmt_harian->execute();
$result_harian = $stmt_harian->get_result();
while ($row = $result_harian->fetch_assoc()) {
    $laporan_harian[] = $row;
}
$stmt_harian->close();

$sql_summary = "SELECT 
                    SUM(total) as total_pendapatan, 
                    COUNT(DISTINCT pelanggan_id) as jumlah_pelanggan 
                FROM 
                    transaksi 
                WHERE 
                    waktu_transaksi BETWEEN ? AND ?";
$stmt_summary = $conn->prepare($sql_summary); 
$stmt_summary->bind_param("ss", $tgl_mulai, $tgl_akhir);
$stmt_summary->execute();
$result_summary = $stmt_summary->get_result();
$summary = $result_summary->fetch_assoc();
$stmt_summary->close();

$judul = "Rekap Laporan Penjualan " . date('d M Y', strtotime($tgl_mulai)) . " sampai " . date('d M Y', strtotime($tgl_akhir));
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <style>
        .rekap-harian, .total-summary {
            border-collapse: collapse;
        }
        .rekap-harian th, .rekap-harian td,
        .total-summary th, .total-summary td {
            border: 1px solid #000;
            padding: 5px;
        }
        .judul-laporan {
            font-size: 11pt;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

<table border="0">
    <tr>
        <td colspan="3" class="judul-laporan"><?php echo $judul; ?></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>

<p>Rekap Total Penerimaan Harian</p>
<table class="rekap-harian">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        if (empty($laporan_harian)) : ?>
            <tr>
                <td colspan="3" class="text-center">Tidak ada data penjualan.</td>
            </tr>
        <?php endif;
        foreach ($laporan_harian as $row): ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><?php echo date('d-M-y', strtotime($row['tanggal'])); ?></td>
            <td class="text-right"><?php echo $row['total_harian']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table border="0">
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>

<p>Total Keseluruhan</p>
<table class="total-summary">
    <thead>
        <tr>
            <th>Keterangan</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jumlah Pelanggan</td>
            <td><?php echo htmlspecialchars($summary['jumlah_pelanggan']); ?> Orang</td>
        </tr>
        <tr>
            <td>Jumlah Pendapatan</td>
            <td><?php echo htmlspecialchars($summary['total_pendapatan']); ?></td>
        </tr>
    </tbody>
</table>

</body>
</html>
<?php
exit;
?>