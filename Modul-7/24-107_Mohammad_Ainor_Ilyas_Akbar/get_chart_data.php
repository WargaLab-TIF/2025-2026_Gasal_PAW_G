<?php
require_once 'config.php';

header('Content-Type: application/json');

$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-01');
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d');

$query = "SELECT 
            DATE(tanggal_transaksi) as tanggal,
            SUM(total_pembayaran) as total
          FROM transaksi
          WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
          GROUP BY DATE(tanggal_transaksi)
          ORDER BY tanggal ASC";

$result = mysqli_query($conn, $query);

$labels = [];
$values = [];

while($row = mysqli_fetch_assoc($result)) {
    $labels[] = date('d/m/Y', strtotime($row['tanggal']));
    $values[] = floatval($row['total']);
}

echo json_encode([
    'labels' => $labels,
    'values' => $values
]);
?>