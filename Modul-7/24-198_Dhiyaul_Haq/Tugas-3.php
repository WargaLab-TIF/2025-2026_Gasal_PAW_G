<?php
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $database = "store";

    $conn = mysqli_connect($server, $user, $pass, $database);

    if(!empty($_POST['awal']) && !empty($_POST['akhir'])) {
        $hasil = $_POST['awal']." sampai ".$_POST['akhir'];
        
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
    } else {
        $hasil = "";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="header">
        <div>
            <h3>Store</h3>
        </div>
        <div>
            <a href="">Supplier</a>
            <a href="">Barang</a>
            <a href="">Transaksi</a>
        </div>
    </div>
    <div class="content">
        <div class="report">
            <h3>Rekap Laporan Penjualan <?php echo $hasil; ?></h3>
            <div>
                <a href="report_transaksi.php">Kembali</a>
            </div>
            <div>
                <canvas id="diagram" height="100%"></canvas>
            </div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
                <?php $num = 1; ?>
                <?php foreach($table1 as $t1): ?>
                    <tr>
                        <td><?php echo $num++ ?></td>
                        <td><?php echo "Rp".number_format($t1['total'], 2, ",", ".") ?></td>
                        <td><?php echo $t1['waktu_transaksi'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <table>
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
                    <tr>
                        <td><?php echo $table2['jumlah_pelanggan'] ?></td>
                        <td><?php echo "Rp".number_format($table2['total'], 2, ",", ".") ?></td>
                    </tr>
            </table>
        </div>
    </div>
    <script>
    const ctx = document.getElementById('diagram');

    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: <?php echo json_encode($tanggal); ?>,
        datasets: [{
            label: 'Total',
            data: <?php echo json_encode($total); ?>,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    </script>
</body>
</html>