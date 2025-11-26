<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    include 'koneksi.php';

    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"laporan_penjualan.xls\"");


    $stmt_harian = $mysqli->prepare("SELECT 
                                      DATE(waktu_transaksi) as tanggal, 
                                      SUM(total) as total_harian
                                    FROM transaksi 
                                    WHERE DATE(waktu_transaksi) BETWEEN ? AND ? 
                                    GROUP BY DATE(waktu_transaksi) 
                                    ORDER BY tanggal ASC");
    $stmt_harian->bind_param("ss", $tgl_mulai, $tgl_selesai);
    $stmt_harian->execute();
    $result_harian = $stmt_harian->get_result();
    $data_laporan = $result_harian->fetch_all(MYSQLI_ASSOC);

    $stmt_total = $mysqli->prepare("SELECT 
                                     SUM(total) as grand_total, 
                                     COUNT(DISTINCT nama_pelanggan) as unique_pelanggan 
                                   FROM transaksi 
                                   WHERE DATE(waktu_transaksi) BETWEEN ? AND ?");
    $stmt_total->bind_param("ss", $tgl_mulai, $tgl_selesai);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $total_result = $result_total->fetch_assoc();

    
    $total_pendapatan = $total_result['grand_total'] ? $total_result['grand_total'] : 0;
    $total_pelanggan = $total_result['unique_pelanggan'] ? $total_result['unique_pelanggan'] : 0;

    echo "<h3>Rekap Laporan Penjualan $tgl_mulai sampai $tgl_selesai</h3>";
    
    echo "<table border='1'>";
    echo "<thead style='background-color: #f2f2f2;'>";
    echo "<tr><th>No</th><th>Tanggal</th><th>Total</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    
    $no = 1;
    foreach ($data_laporan as $row) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . date('d Nov Y', strtotime($row['tanggal'])) . "</td>";
        echo "<td>Rp" . number_format($row['total_harian'], 0, ',', '.') . "</td>";
        echo "</tr>";
    }
    
    echo "</tbody></table>";

    echo "<br><br>";

    echo "<table border='1'>";
    echo "<thead style='background-color: #f2f2f2;'>";
    echo "<tr><th>Jumlah Pelanggan</th><th>Jumlah Pendapatan</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>" . $total_pelanggan . " Orang</td>";
    echo "<td>Rp" . number_format($total_pendapatan, 0, ',', '.') . "</td>";
    echo "</tr>";
    echo "</tbody></table>";

} else {
    header('Location: index.php');
}
?>