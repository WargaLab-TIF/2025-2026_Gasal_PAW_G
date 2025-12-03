<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location:index.php");
}

$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT id FROM pelanggan";
$return = mysqli_query($conn, $query);
$pelanggan = mysqli_fetch_all($return, MYSQLI_ASSOC);

function validateWaktu(&$error, $field)
{
    date_default_timezone_set("Asia/Jakarta");
    $input = new DateTime($field);
    $now = new DateTime();
    if (empty($field)) {
        $error['waktu'] = "Tidak boleh kosong";
    } elseif ($input->format("Y-m-d") < $now->format("Y-m-d")) {
        $error['waktu'] = "Tidak bisa memilih tanggal tersebut";
    }
}
function validateKet(&$error, $field)
{
    if (empty($field)) {
        $error['keterangan'] = "Tidak boleh kosong";
    }
    if (strlen($field) < 3) {
        $error['keterangan'] = "Tidak boleh kurang dari 3 karakter";
    }
}
function validateTotal(&$error, $field)
{
    if (!preg_match("/^[0-9]+$/", $field)) {
        $error['total'] = "Hanya boleh angka";
    }
}

$error = [];
$waktu = $_POST['waktu'] ?? "";
$keterangan = $_POST['keterangan'] ?? "";
$total = $_POST['total'] ?? "0";
$id_pelanggan = $_POST['pelanggan'] ?? "";
if (isset($_POST['tambah'])) {
    validateWaktu($error, $waktu);
    validateKet($error, $keterangan);
    validateTotal($error, $total);
}

if (isset($_POST['tambah'])) {
    if (count($error) == 0) {
        $waktu = $_POST['waktu'];
        $keterangan = $_POST['keterangan'];
        $total = $_POST['total'];
        $pelanggan_id = $_POST['pelanggan'];

        $query = "INSERT INTO transaksi(waktu_transaksi,keterangan,total,pelanggan_id) VALUES ('$waktu','$keterangan','$total','$pelanggan_id')";
        if (mysqli_query($conn, $query)) {
            header('location:transaksi_detail.php');
        }
    }
}

if(isset($_POST['batal'])){
    header("location:pilihtrans.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        h2 {
            background-color: lightgray;
            text-align: center;
            padding: 10px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            padding: 10px;
        }

        .tambah {
            background-color: lightslategray;
            color: white;
            padding: 10px;
            border-radius: 10px;
            border: none;
        }

        .tambah:hover {
            background-color: black;
            color: lightskyblue;
            padding: 10px;
            border-radius: 10px;
        }
        .batal {
            background-color: lightslategray;
            color: white;
            padding: 10px;
            border-radius: 10px;
            border: none;
        }

        .batal:hover {
            background-color: black;
            color: lightskyblue;
            padding: 10px;
            border-radius: 10px;
        }

        span {
            color: red;
        }

        label {
            color: grey;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Tambah Data Transaksi</h2><br>
    <form action="transaksi.php" method="post">

        <table border="0">
            <tr>
                <td><label for="waktu" style="text-align: left;">Waktu Transaksi</label></td>
            </tr>
            <tr>
                <td><input type="date" name="waktu" style="width: 300px; height:30px;" value="<?= $waktu ?>"></td>
            </tr>
            <tr>
                <td><span><?php echo $error['waktu'] ?? "" ?></span></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td><label for="keterangan" style="text-align: left;">Keterangan</label></td>
            </tr>
            <tr>
                <td><textarea name="keterangan" placeholder="Masukkan keterangan transaksi" style="width: 298px; height:50px;"><?= $keterangan ?></textarea></td>
            </tr>
            <tr>
                <td><span><?php echo $error['keterangan'] ?? "" ?></span></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td><label for="total" style="text-align: left;">Total</label></td>
            </tr>
            <tr>
                <td><input type="text" name="total" value="<?= $total ?? "0" ?>" style="width: 297px; height:30px;"></td>
                <td><span><?php echo $error['total'] ?? "" ?></span></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td><label for="pelanggan" style="text-align: left;">Pelanggan</label></td>
            </tr>
            <tr>
                <td>
                    <select name="pelanggan" style="width: 304px; height:30px;">
                        <option>Pilih Pelanggan</option>
                        <?php foreach ($pelanggan as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['id'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span><?php echo $error['pelanggan'] ?? "" ?></span></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td>
                    <input type="submit" name="tambah" value="Tambah Transaksi" style="width: 250px;" class="tambah">
                    <button type="submit" name="batal" class="batal">Batal</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>