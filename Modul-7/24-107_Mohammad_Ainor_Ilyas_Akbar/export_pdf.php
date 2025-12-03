<?php
require_once 'config.php';

// Install TCPDF dulu: composer require tecnickcom/tcpdf
require_once('vendor/autoload.php');

$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-01');
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d');

// Query data
$query = "SELECT 
            DATE(t.tanggal_transaksi) as tanggal,
            COUNT(DISTINCT t.id_pelanggan) as jumlah_pelanggan,
            SUM(t.total_pembayaran) as total_penerimaan
          FROM transaksi t
          WHERE t.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
          GROUP BY DATE(t.tanggal_transaksi)
          ORDER BY tanggal ASC";
$result = mysqli_query($conn, $query);

// Query total
$query_total = "SELECT 
                COUNT(DISTINCT id_pelanggan) as total_pelanggan,
                SUM(total_pembayaran) as total_pendapatan
                FROM transaksi
                WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$result_total = mysqli_query($conn, $query_total);
$total_data = mysqli_fetch_assoc($result_total);

// Buat PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistem Penjualan');
$pdf->SetTitle('Laporan Penjualan');
$pdf->SetSubject('Laporan');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'LAPORAN PENJUALAN', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'Periode: ' . date('d-m-Y', strtotime($tanggal_awal)) . ' s/d ' . date('d-m-Y', strtotime($tanggal_akhir)), 0, 1, 'C');
$pdf->Ln(10);

// Tabel
$html = '<table border="1" cellpadding="5">
    <thead>
        <tr style="background-color: #667eea; color: white;">
            <th width="10%">No</th>
            <th width="30%">Tanggal</th>
            <th width="30%">Jumlah Pelanggan</th>
            <th width="30%">Total Penerimaan</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
while($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>
        <td>' . $no++ .