<?php
    include "auth.php";
    include "fungsi.php";

    if(!empty($_POST['awal']) && !empty($_POST['akhir'])) {
        $hasil = $_POST['awal']." sampai ".$_POST['akhir'];
        
        $awal = htmlspecialchars($_POST['awal']);
        $akhir = htmlspecialchars($_POST['akhir']);

        $stmt1 = $conn->prepare("
            SELECT waktu_transaksi, SUM(total) AS total 
            FROM transaksi
            WHERE waktu_transaksi BETWEEN ? AND ?
            GROUP BY waktu_transaksi
        ");
        $stmt1->bind_param("ss", $awal, $akhir);
        $stmt1->execute();
        $table1 = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);

        $stmt2 = $conn->prepare("
            SELECT COUNT(pelanggan_id) AS jumlah_pelanggan, SUM(total) AS total 
            FROM transaksi 
            WHERE waktu_transaksi BETWEEN ? AND ?
        ");
        $stmt2->bind_param("ss", $awal, $akhir);
        $stmt2->execute();
        $table2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC)[0];

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
    <style>
        @media print {
            .header, .cetak, a[href], button {
                display: none !important;
            }
            
            .canvas-diagram, #diagram {
                display: block !important;
            }
        }
        * {
            margin: 0;
            padding: 0;
        } 
        h1 {
            text-align: center;
            padding: 1vh 0vh;
            box-shadow: 2px 2px 5px grey;
        }
    </style>
</head>
<body>
    <h1>Rekap Laporan Penjualan <?php echo $hasil; ?></h1>
    <div class="content">
        <a href="laporan.php">Kembali</a>
        <div>
            <button onclick="window.print()" class="cetak">Cetak</button>
            <form action="excel.php" method="POST">
                <input type="hidden" name="awal" value="<?php echo $awal ?>">
                <input type="hidden" name="akhir" value="<?php echo $akhir ?>">
                <button type="submit" class="cetak">Excel</button>
            </form>
        </div>
        <div class="canvas-diagram">
            <canvas id="diagram"></canvas>
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