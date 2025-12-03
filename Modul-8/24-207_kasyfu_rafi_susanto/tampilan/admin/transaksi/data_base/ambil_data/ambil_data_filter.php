<?php 
require_once __DIR__. "../../koneksi.php";


if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["tampilkan"])){
    $tanggal_awal = $_POST["tanggal-awal"];
    $tanggal_akhir = $_POST["tanggal-akhir"];
    $filter_date = "SELECT waktu_transaksi, FORMAT(sum(total),0,'id_ID') AS total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
    
    $find_data = $conn->query($filter_date);
    $ls_dt = [];
    while($row = $find_data->fetch_assoc()){
        $ls_dt[] = $row;
    }

    // digunakan untuk  totaal
    $select_total = "SELECT FORMAT(sum(total),0,'id_ID') AS total,COUNT(DISTINCT pelanggan_id) AS total_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    
    $find_total = $conn->query($select_total);
    $ls_total = [];
    while($row = $find_total->fetch_assoc()){
        $ls_total[] = $row;
    }
    $tipe = "hilang";
    require_once __DIR__. "../../../tampilan/report/print_export.php";
    require_once __DIR__. "../../../tampilan/report/chart.php";
    require_once __DIR__. "../../../tampilan/report/tabel.php";
    require_once __DIR__. "../../../tampilan/report/rekap.php";
}

?>