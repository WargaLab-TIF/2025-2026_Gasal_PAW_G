<?php
ob_start();

include "../koneksi.php";
require "../fpdf.php";

$q = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
    ORDER BY t.waktu_transaksi DESC
");

$sum = mysqli_query($conn, "SELECT SUM(total) AS total_all FROM transaksi");
$total_all = mysqli_fetch_assoc($sum)['total_all'];

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'LAPORAN PENJUALAN', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'ID', 1);
$pdf->Cell(30, 8, 'Tanggal', 1);
$pdf->Cell(40, 8, 'Pelanggan', 1);
$pdf->Cell(80, 8, 'Keterangan', 1);
$pdf->Cell(30, 8, 'Total', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
while ($data = mysqli_fetch_assoc($q)) {
    $pdf->Cell(10, 7, $data['id'], 1);
    $pdf->Cell(30, 7, date('d-m-Y', strtotime($data['waktu_transaksi'])), 1);
    $pdf->Cell(40, 7, $data['pelanggan'] ?? '-', 1);
    $pdf->Cell(80, 7, $data['keterangan'], 1);
    $pdf->Cell(30, 7, number_format($data['total'], 0, ',', '.'), 1, 0, 'R');
    $pdf->Ln();
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(160, 8, 'TOTAL KESELURUHAN', 1, 0, 'R');
$pdf->Cell(30, 8, number_format($total_all, 0, ',', '.'), 1, 1, 'R');

$pdf->Output('I', 'laporan_penjualan.pdf');
ob_end_flush();
?>