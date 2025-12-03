<?php
$tanggal_aw = $_POST['awal'] ?? '';
$tanggal_ak = $_POST['akhir'] ?? '';
$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT t.waktu_transaksi,SUM(t.total) AS total,t.pelanggan_id FROM transaksi AS t WHERE t.waktu_transaksi BETWEEN '$tanggal_aw' AND '$tanggal_ak' GROUP BY t.waktu_transaksi ORDER BY t.waktu_transaksi ASC";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$waktu = [];
foreach ($data as $d) {
    $w = $d['waktu_transaksi'];
    $waktu[] = $w;
}

$waktu2 = [];
foreach ($waktu as $wk) {
    $tanggal = date("d M Y", strtotime($wk));
    $waktu2[] = $tanggal;
}


$total = [];
foreach ($data as $d) {
    $t = $d['total'];
    $total[] = $t;
}

$query = "SELECT t.pelanggan_id FROM transaksi AS t WHERE t.waktu_transaksi BETWEEN '$tanggal_aw' AND '$tanggal_ak' GROUP BY t.pelanggan_id";
$result = mysqli_query($conn, $query);
$id_pelanggan = mysqli_fetch_all($result, MYSQLI_ASSOC);
$pelanggan = [];
foreach ($id_pelanggan as $id) {
    $p = $id['pelanggan_id'];
    $pelanggan[] = $p;
}
$jumlah_total = 0;
foreach ($total as $t) {
    $jumlah_total = $jumlah_total + $t;
}

if (isset($_POST['kembali'])) {
    header("location:index.php");
}

if (isset($_POST['excel'])) {
    header("Location:excel.php?aw=" . $tanggal_aw . "&ak=" . $tanggal_ak);
    exit;
}
$error = [];
function validateAwal(&$error, $field)
{
    if (empty($field)) {
        $error['tanggal_aw'] = "Tidak boleh kosong";
    }
}
function validateAkhir(&$error, $field)
{
    if (empty($field)) {
        $error['tanggal_ak'] = "Tidak boleh kosong";
    }
}
if (isset($_POST['tampil'])) {
    validateAwal($error, $tanggal_aw);
    validateAkhir($error, $tanggal_ak);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media print {
            .no_print {
                display: none;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }


        h2 {
            background-color: lightcyan;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }

        .kembali {
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .kembali:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }

        .awal {
            width: 150px;
            height: 25px;
            border-radius: 10px;
            margin-right: 10px;
        }

        .akhir {
            width: 150px;
            height: 25px;
            border-radius: 10px;
            margin-right: 10px;
        }

        .tampil {
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .tampil:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }

        .cetak {
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .cetak:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }

        .excel {
            border: 0;
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .excel:hover {
            border: 0;
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }

        .tb_total {
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            width: 100%;
            border: none;
        }

        .tb_rekap {
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            width: 100%;
            border: none;
        }

        .tb_total th {
            background-color: lightcyan;
            border-radius: 10px;
        }

        .tb_rekap th {
            background-color: lightcyan;
            border-radius: 10px;
        }

        .tb_rekap td:hover {
            background-color: grey;
            border-radius: 10px;
        }

        .tb_total td:hover {
            background-color: grey;
            border-radius: 10px;
        }

        fieldset {
            border: 2px solid black;
            padding: 10px;
            border-radius: 5px;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <?php if (empty($tanggal_aw)  && empty($tanggal_ak)): ?>
        <h2>Rekap Laporan Penjualan</h2>
    <?php else: ?>
        <h2><?php echo "Rekap Laporan Penjualan $tanggal_aw sampai $tanggal_ak" ?></h2>
    <?php endif ?>
    <div class="no_print">
        <fieldset style="margin-bottom: 10px;">
            <form action=report_transaksi.php method="post">
                <table>
                    <tr>
                        <td>
                            <button type="submit" name="kembali" class="kembali">
                                < Kembali</button><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="awal" class="awal" value="<?= $tanggal_aw ?>">
                        </td>
                        <td>
                            <input type="date" name="akhir" class="akhir" value="<?= $tanggal_ak ?>">
                        </td>
                        <td>
                            <button type="submit" name="tampil" class="tampil">Tampilkan</button><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><?php echo $error['tanggal_aw'] ?? " " ?></span>
                        </td>
                        <td>
                            <span><?php echo $error['tanggal_ak'] ?? " " ?></span>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </div>
    <?php if (isset($_POST['tampil'])): ?>
        <?php if (count($error) == 0): ?>
            <fieldset>
                <div class="no_print">
                    <form action="report_transaksi.php" method="post">
                        <input type="hidden" name="awal" class="awal" value="<?= $tanggal_aw ?>">
                        <input type="hidden" name="akhir" class="akhir" value="<?= $tanggal_ak ?>">

                        <button onclick="window.print()" class="cetak">Cetak</button>
                        <button type="submit" name="excel" class="excel">Excel</button>
                    </form>
                </div>
                <div style="width: auto; height: 500px;">
                    <canvas id="myChart"></canvas>
                </div>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($waktu); ?>,
                            datasets: [{
                                label: "total",
                                data: <?php echo json_encode($total); ?>,
                                backgroundColor: ["rgba(43, 47, 47, 0.2)"],
                                borderColor: ["rgba(72, 76, 76, 1)"],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    max: 2500000
                                }
                            }
                        }
                    });
                </script>
                <br>
                <table border="0" cellpadding="15px" cellspacing="5px" class="tb_rekap">
                    <tr>
                        <th>No</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                    <?php for ($rows = 0; $rows < count($waktu); $rows++): ?>
                        <tr>
                            <td>
                                <?php echo $rows + 1 ?>
                            </td>
                            <td>
                                <?php echo $total[$rows] ?>
                            </td>
                            <td>
                                <?php echo $waktu2[$rows] ?>
                            </td>
                        </tr>
                    <?php endfor ?>
                </table>
                <br>
                <table border="0" cellpadding="15px" cellspacing="5px" class="tb_total">
                    <tr>
                        <th>Jumlah Pelanggan</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>
                    <tr>
                        <td><?php echo count($pelanggan) . " orang" ?></td>
                        <td><?php echo $jumlah_total ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        <?php endif; ?>
            </fieldset>
</body>

</html>