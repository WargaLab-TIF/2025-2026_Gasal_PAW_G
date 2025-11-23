<?php 
    include "auth.php";
    include "fungsi.php";

    $awal = htmlspecialchars($_POST['awal']);
    $akhir = htmlspecialchars($_POST['akhir']);

    $stmt1 = $conn->prepare("SELECT waktu_transaksi, SUM(total) AS total 
                            FROM transaksi
                            WHERE waktu_transaksi BETWEEN ? AND ?
                            GROUP BY waktu_transaksi");
    $stmt1->bind_param("ss", $awal, $akhir);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $table1 = $result1->fetch_all(MYSQLI_ASSOC);

    $stmt2 = $conn->prepare("SELECT COUNT(pelanggan_id) AS jumlah_pelanggan, SUM(total) AS total 
                            FROM transaksi 
                            WHERE waktu_transaksi BETWEEN ? AND ?");
    $stmt2->bind_param("ss", $awal, $akhir);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $table2 = $result2->fetch_assoc();

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
