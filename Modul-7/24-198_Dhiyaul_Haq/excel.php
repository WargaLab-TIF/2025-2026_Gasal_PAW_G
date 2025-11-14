<?php 
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $database = "store";

    $conn = mysqli_connect($server, $user, $pass, $database);

    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

    $query1 = mysqli_query($conn, "select waktu_transaksi, sum(total) as total from transaksi
                                where waktu_transaksi between '$awal' and '$akhir'
                                group by waktu_transaksi;");
    $query2 = mysqli_query($conn, "select count(pelanggan_id) as jumlah_pelanggan, sum(total) as total from transaksi 
                                    where waktu_transaksi between '$awal' and '$akhir';");
    $table1 = mysqli_fetch_all($query1, MYSQLI_ASSOC);
    $table2 = mysqli_fetch_all($query2, MYSQLI_ASSOC)[0];

    $tanggal = [];
    foreach($table1 as $t1) {
        $tanggal[] = $t1['waktu_transaksi'];
    }
    $total = [];
    foreach($table1 as $t2) {
        $total[] = $t2['total'];
    }

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=laporan_transaksi_$awal-$akhir.xls");

    echo "Rekap Laporan Penjualan $awal sampai $akhir";
    echo "<br>";
    echo "<br>";
    
    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>";

    $num = 1;
    foreach($table1 as $t1) {
        echo "<tr>";
        echo "<td>".$num++."</td>";
        echo "<td>"."Rp".number_format($t1['total'], 2, ",", ".")."</td>";
        echo "<td>".$t1['waktu_transaksi']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br>";

    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Jumlah Pelanggan</th>";
    echo "<th>Jumlah Pendapatan</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>".$table2['jumlah_pelanggan']."</td>";
    echo "<td>".$table2['total']."</td>";
    echo "</tr>";
    echo "</table>";
?>
