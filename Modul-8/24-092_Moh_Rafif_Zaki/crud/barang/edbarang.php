<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location:../../index.php");
}

$conn = mysqli_connect("localhost", "root", "", "penjualan");
function validatenama(&$error, $field)
{
    if (empty($field)) {
        $error['nama'] = "Tidak Boleh Kosong";
    }
}


function validateharga(&$error, $field)
{
    if (empty($field)) {
        $error['harga'] = "Tidak Boleh Kosong";
    } elseif (!preg_match("/^[0-9]+$/", $field)) {
        $error['harga'] = 'Hanya boleh angka';
    }elseif (!preg_match("/^(?!0\d)\d+$/", $field)) {
    $error['harga'] = 'Tidak boleh 0 didepan';
    }
}

function validatestok(&$error, $field)
{
    if (empty($field)) {
        $error['stok'] = "Tidak Boleh Kosong";
    } elseif (!preg_match("/^(?!0\d)\d+$/", $field)) {
        $error['stok'] = 'Tidak boleh 0 didepan';
    }
}


$id = $_GET['id'] ?? "";
$query = "SELECT * FROM barang WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);

$error = [];

$kodebarang = $data['kode_barang'] ?? "";
$kode = substr($kodebarang, 0, 3) ?? $_POST['kode'];
$kodebr = substr($kodebarang, 4, 5) ?? $_POST['kodebr'];

$nama = $data['nama_barang'] ?? $_POST['nama'];
$harga = $data['harga'] ?? $_POST['harga'];
$stok = $data['stok'] ?? $_POST['stok'];
$id_supplier = $data['supplier_id'] ?? $_POST['id_supplier'];

if (isset($_POST['update'])) {

    $id = htmlspecialchars($_GET['id'] ?? "");
    $kode = htmlspecialchars($_POST['kode'] ?? "");
    $kodebr = htmlspecialchars($_POST['kodebr'] ?? "");

    $error = [];
    $kodebarang = htmlspecialchars(($kode . $kodebr) ?? "");
    $nama = htmlspecialchars($_POST['nama'] ?? "");
    $harga = htmlspecialchars($_POST['harga'] ?? "");
    $stok = htmlspecialchars($_POST['stok'] ?? "");
    $id_supplier = htmlspecialchars($_POST['id_supplier'] ?? "");

    validatenama($error, $nama);
    validateharga($error, $harga);
    validatestok($error, $stok);

    if (count($error) == 0) {

        $query = "UPDATE barang SET kode_barang = ?,nama_barang = ?,harga = ?,stok = ?,supplier_id = ? WHERE id = ? ";
        $prepare = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($prepare,"ssiiii",$kodebarang,$nama,$harga,$stok,$id_supplier,$id);
        mysqli_stmt_execute($prepare);
        
        header("location:../../barang.php");
    }
}
if (isset($_POST['batal'])) {
    header("location:../../barang.php");
}

$query = "SELECT id FROM supplier WHERE id !=".$data['supplier_id'] ?? "";
$result = mysqli_query($conn, $query);
$supplier = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2 {
            background-color: lightcyan;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }

        input {
            width: 300px;
            height: 30px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            padding: 20px;
        }

        .update {
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
            border: none;

        }

        .update:hover {
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
            border: none;

        }

        .batal {
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
            border: none;
        }

        .batal:hover {
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
            border: none;

        }

        span {
            color: red;
        }

        label {
            color: lightseagreen;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Edit Data Barang</h2>
    <form action="edbarang.php?id=<?= $id ?>" method="post">
        <table>
            <tr>
                <td><label for="kode_barang">Masukkan kode barang:</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="kode" value="<?= "BRG0" ?? $kode ?>" readonly>
                </td>
                <td>
                    <input type="number" name="kodebr" value="<?= $kodebr ?>" style="width: 150px;" readonly><br>
                </td>
            </tr>
            <tr>
                <td><span><?php echo $error['kode_barang'] ?? "" ?></span></td>
            </tr>
            <tr>
                <td><label for="nama">Masukkan nama barang:</label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="nama" value="<?= $nama ?? "" ?>" style="width: 463px;"><br>
                    <span><?php echo $error['nama'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
            <tr>
                <td><label for="harga">Masukkan harga:</label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="harga" value="<?= $harga ?? "" ?>" style="width: 463px;"><br>
                    <span><?php echo $error['harga'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="stok">Masukkan stok:</label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="stok" value="<?= $stok ?? "" ?>" style="width: 463px;"><br>
                    <span><?php echo $error['stok'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="id_supplier">Pilih ID supplier:</label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <select name="id_supplier" style="width: 470px; height: 30px;">
                        <option value="<?= $id_supplier ?>"><?php echo $id_supplier ?></option>
                        <?php foreach ($supplier as $s): ?>
                            <option value="<?= $s['id'] ?>"><?php echo $s['id'] ?></option>
                        <?php endforeach ?>
                    </select><br>
                    <span><?php echo $error['id_supplier'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="batal" class="batal">Batal</button>
                    <button type="submit" name="update" class="update">Update</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>