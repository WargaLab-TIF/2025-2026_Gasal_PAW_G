<?php

require_once __DIR__."../../../data_base/koneksi/koneksi.php";
require_once __DIR__."../../admin/transaksi/data_base/ambil_data/ambil_data.php";
$no = 1;
session_start();
if(!isset($_SESSION["login"])|| $_SESSION["level"] != 2){
    header("location:../../form_login.php");
}
$page = "laporan";

function excel(){
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reposting.xls");
}

$tipe = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        #hilang{
            display: none;
        }
        @media print{
            body *{
                visibility: hidden;
            }
            .no-print{
                display: none !important;
            }
            .area-cetak, .area-cetak *{
                visibility: visible;
            }
            .area-cetak{
                width: 100%;
            }
        }
    </style>
    <title>Master-Transaksi</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <?php require_once __DIR__. "/navbar.php" ?>
        <div class="w-auto m-3 shadow-sm">
            <div class="bg-primary d-flex align-items-center ps-2" style="height: 40px;">
                <p class="fw-bold text-white m-0">Rekap-Transaksi</p><p class="fw-bold text-white m-0"></p>
            </div>
            <div class="mt-3 ps-1 d-flex justify-content-start">
                <a href="../admin/transaksi.php" class="btn btn-primary ms-1">&lt;Kembali</a>
            </div>
            
            <div class="m-2">
                <?php if(!isset($_POST["tampilkan"])):?>
                <form  method="POST" class="d-flex tampil <?= $tipe ?>">
                    <input type="date" name="tanggal-awal">
                    <input type="date" name="tanggal-akhir" class="ms-2">
                    <button class="btn btn-success text-center ms-2 py-1" name="tampilkan">Tampilkan</button>
                </form>
                <?php endif ?>
            </div>
            <div class="m-2 area-cetak">
                <?php require_once __DIR__. "../../admin/transaksi/data_base/ambil_data/ambil_data_filter.php" ?>
            </div>
        </div>

    </div>
</body>
</html>