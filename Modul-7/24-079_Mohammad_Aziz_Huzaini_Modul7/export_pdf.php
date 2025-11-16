<?php
require_once 'koneksi.php';

$tanggal_mulai  = $_GET['tanggal_mulai'] ?? date("Y-m-d");
$tanggal_akhir  = $_GET['tanggal_akhir'] ?? date("Y-m-d");

$query = "SELECT 
            DATE(waktu_transaksi) as tanggal,
            COUNT(DISTINCT pelanggan_id) as jumlah_pelanggan,
            SUM(total) as total_penerimaan
          FROM transaksi
          WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
          GROUP BY DATE(waktu_transaksi)
          ORDER BY tanggal ASC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $tanggal_mulai, $tanggal_akhir);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$laporan_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query_total = "SELECT 
                COUNT(DISTINCT pelanggan_id) as total_pelanggan,
                SUM(total) as total_pendapatan
              FROM transaksi
              WHERE DATE(waktu_transaksi) BETWEEN ? AND ?";

$stmt2 = mysqli_prepare($conn, $query_total);
mysqli_stmt_bind_param($stmt2, "ss", $tanggal_mulai, $tanggal_akhir);
mysqli_stmt_execute($stmt2);
$result_total = mysqli_stmt_get_result($stmt2);
$total_data = mysqli_fetch_assoc($result_total);

$total_pelanggan  = $total_data['total_pelanggan'] ?? 0;
$total_pendapatan = $total_data['total_pendapatan'] ?? 0;

$pdf  = "%PDF-1.4\n";
$pdf .= "1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n";
$pdf .= "2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n";

$content  = "Rekap Laporan Penjualan\n";
$content .= date("d M Y", strtotime($tanggal_mulai)) . " - " . date("d M Y", strtotime($tanggal_akhir)) . "\n\n";

$content .= "No | Tanggal     | Pelanggan | Total Penerimaan\n";
$content .= "------------------------------------------------------\n";

$no = 1;
foreach ($laporan_data as $d) {
    $content .= sprintf(
        "%-3s %-12s %-10s Rp %s\n",
        $no++,
        date("d-m-Y", strtotime($d['tanggal'])),
        $d['jumlah_pelanggan'],
        number_format($d['total_penerimaan'], 0, ",", ".")
    );
}

$content .= "\nTOTAL RINGKASAN:\n";
$content .= "Total Pelanggan : " . $total_pelanggan . " Orang\n";
$content .= "Total Pendapatan: Rp " . number_format($total_pendapatan, 0, ",", ".") . "\n";

$stream_text = str_replace(
    ["\\", "(", ")"],
    ["\\\\", "\\(", "\\)"],
    $content
);

$pdf .= "3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 595 842]/Contents 4 0 R>>endobj\n";

$pdf .= "4 0 obj<< /Length " . strlen("BT /F1 12 Tf 50 780 Td ({$stream_text}) Tj ET") . " >>stream\n";
$pdf .= "BT /F1 12 Tf 50 780 Td ({$stream_text}) Tj ET\n";
$pdf .= "endstream\nendobj\n";

$pdf .= "5 0 obj<</Type/Font/Subtype/Type1/BaseFont/Helvetica>>endobj\n";

$pdf .= "xref\n0 6\n0000000000 65535 f \n";
$pdf .= "0000000010 00000 n \n";
$pdf .= "0000000060 00000 n \n";
$pdf .= "0000000117 00000 n \n";
$pdf .= "0000000220 00000 n \n";
$pdf .= "0000000380 00000 n \n";
$pdf .= "trailer<</Size 6/Root 1 0 R>>\n";
$pdf .= "startxref\n500\n%%EOF";

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=Laporan_Penjualan.pdf");
echo $pdf;
exit;
?>
