<?php
    $conn = mysqli_connect("localhost", "root", "", "penjualan");
    $tanggal_awal = isset($_POST['tanggal_awal']) ? $_POST['tanggal_awal'] : '2025-11-01'; 
    $tanggal_akhir = isset($_POST['tanggal_akhir']) ? $_POST['tanggal_akhir'] : '2025-11-05'; 

    $sql_rekap = "SELECT DATE(t.waktu_transaksi) AS tanggal, SUM(t.total) AS total_pendapatan, COUNT(t.id) AS jumlah_pelanggan
                  FROM transaksi AS t
                  WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                  GROUP BY DATE(t.waktu_transaksi)
                  ORDER BY tanggal ASC;";

    $rekap_sql = mysqli_query($conn, $sql_rekap);
    $rekap = [];
    while($row = mysqli_fetch_assoc($rekap_sql)) {
        $rekap[] = $row;
    }
    $tanggal = array_map(function($r) {
        return $r['tanggal'];
    }, $rekap);

    $total_pendapatan = array_map(function($r) {
        return (int)$r['total_pendapatan']; 
    }, $rekap);

    $jumlah_pelanggan = array_map(function($r) {
        return (int)$r['jumlah_pelanggan'];
    }, $rekap);

    $total_kumulatif_pelanggan = array_sum($jumlah_pelanggan);
    $total_kumulatif_pendapatan = array_sum($total_pendapatan);

    if (empty($tanggal)) {
        $tanggal = ['Tidak Ada Data'];
        $total_pendapatan = [0];
        $jumlah_pelanggan = [0];
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <style>
        .judul-laporan {
            background-color: #3313ebff;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
            font-size: 1.5em;
            font-weight: bold;
        }

        .btn-kembali, .btn-print, .btn-excel {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .btn-print { background-color: #ecf807ff; }

        @media print {
            .btn-kembali, .btn-print, .judul-laporan {
                display: none !important;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th { background-color: #eaf2f8; }
    </style>
</head>
<body>
    <h2 class="judul-laporan">Rekap Laporan Penjualan <?php echo $tanggal_awal; ?> sampai <?php echo $tanggal_akhir; ?></h2>

    <a href="report_transaksi.php" class="btn-kembali">Kembali</a><br>
    <button class="btn-print" onclick="window.print()">cetak</button>
    <button class="btn-print" onclick="downloadExcel()">Download Excel</button>
    
    <div style="width: 80%; margin: 0 auto;">
        <canvas id="penjualan"></canvas>
    </div>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($rekap as $row) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>Rp<?php echo number_format($row['total_pendapatan'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <div class="table">
        <?php
            echo "<table border='1' cellpadding='10'>";
            echo "<tr>
                    <th>Total Pelanggan</th>
                    <th>Total Pendapatan</th>
            </tr>";
            echo "<tr>
                    <td>$total_kumulatif_pelanggan Orang</td>
                    <td>Rp" . number_format($total_kumulatif_pendapatan, 0, ',', '.') . "</td>
            </tr>";
            echo "</table>";

        ?>
        
    </div>

    <script>
        const ctx = document.getElementById('penjualan').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($tanggal); ?>,
                datasets: [{
                    label: 'Total Pendapatan (Rp)',
                    data: <?php echo json_encode($total_pendapatan); ?>,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp' + context.parsed.y.toLocaleString();
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    function downloadExcel() {
        const judul = "Rekap Laporan Penjualan <?= $tanggal_awal ?> sampai <?= $tanggal_akhir ?>";

        const excelData = [];
        excelData.push([judul]);
        excelData.push([]);

        excelData.push(["No", "Total", "Tanggal"]);

        <?php $no = 1; foreach ($rekap as $r): ?>
            excelData.push([
                "<?= $no++ ?>",
                "Rp<?= number_format($r['total_pendapatan'], 0, ',', '.') ?>",
                "<?= $r['tanggal'] ?>"
            ]);
        <?php endforeach; ?>

        excelData.push([]);
        excelData.push(["Jumlah Pelanggan", "Jumlah Pendapatan"]);
        excelData.push([
            "<?= $total_kumulatif_pelanggan ?> Orang",
            "Rp<?= number_format($total_kumulatif_pendapatan, 0, ',', '.') ?>"
        ]);

        const ws = XLSX.utils.aoa_to_sheet(excelData);

        ws['!merges'] = [
            { s:{r:0,c:0}, e:{r:0,c:2} }
        ];

        ws['!cols'] = [
            { wpx: 60 },
            { wpx: 150 },
            { wpx: 120 }
        ];

        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Laporan");

        XLSX.writeFile(wb, "laporan_penjualan.xlsx");
    }
    </script>

</body>
</html>
