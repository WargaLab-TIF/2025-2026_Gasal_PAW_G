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
    } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $field)) {
        $error['nama'] = 'Hanya boleh huruf';
    }
}

function validatetelp(&$error, $field)
{
    if (empty($field)) {
        $error['telp'] = "Tidak Boleh Kosong";
    } elseif (!preg_match("/^[0-9]+$/", $field)) {
        $error['telp'] = 'Hanya boleh angka';
    } elseif (strlen($field) < 11 || strlen($field) > 13) {
        $error['telp'] = 'No telepon harus sebanyak 11-13 angka';
    }
}

function validatealamat(&$error, $field)
{
    if (empty($field)) {
        $error['alamat'] = 'Tidak boleh kosong';
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s.,]+$/", $field)) {
        $error['alamat'] = 'Minimal 1 angka dan 1 huruf';
    }
}

function validateJK(&$error, $field)
{
    if ($field == "Pilih Jenis Kelamin") {
        $error['jenis_k'] = "Tidak boleh dipilih";
    }
}

$idget = $_GET['id'];
$query = "SELECT * FROM pelanggan WHERE id = '$idget'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_array($result);


$idp = $data['id'];
$idpl = substr($idp,0,2) ?? "";
$idtg = substr($idp,3,11) ?? "";
$id = substr($idp,14) ?? "";

$error = [];
$nama = $data['nama'] ?? "";
$jenis_k = $data['jenis_kelamin'] ?? "";
$telp = $data['telp'] ?? "";
$alamat = $data['alamat'] ?? "";

if (isset($_POST['update'])) {
    $idpl = htmlspecialchars($_POST['idpl'] ?? "");
    $idtg = htmlspecialchars($_POST['idtg'] ?? "");
    $id = htmlspecialchars($_POST['id'] ?? "");

    $error = [];
    $idgab = htmlspecialchars(($idpl . $idtg . $id) ?? "");
    $nama = htmlspecialchars($_POST['nama'] ?? "");
    $jenis_k = htmlspecialchars($_POST['jenis_k'] ?? "");
    $telp = htmlspecialchars($_POST['telp'] ?? "");
    $alamat = htmlspecialchars($_POST['alamat'] ?? "");

    validatenama($error, $nama);
    validatetelp($error, $telp);
    validatealamat($error, $alamat);
    validateJK($error, $jenis_k);
    if (count($error) == 0) {
        $query = "UPDATE pelanggan SET nama = ?,jenis_kelamin = ?,telp = ?,alamat = ? WHERE id = ?";
        $prepare = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($prepare,"sssss",$nama,$jenis_k,$telp,$alamat,$idgab);
        if (mysqli_stmt_execute($prepare)) {
            header("location:../../pelanggan.php");
        } else {
            echo "Data gagal ditambahkan";
        }
    }
}
if (isset($_POST['batal'])) {
    header("location:../../pelanggan.php");
}
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

        textarea {
            width: 300px;
            height: 80px;
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
    <h2>Tambah Data Pelanggan</h2>
    <form action="edpelanggan.php?id=<?= $idp ?>" method="post">
        <table border="0">
            <tr>
                <td><label for="id">Masukkan ID:</label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="idpl" value="PLG" readonly style="width: 35px;">
                    <input type="text" name="idtg" value="<?= $idtg ?? "" ?>" readonly style="width: 93px;">
                    <input type="text" name="id" value="<?= $id ?? "" ?>" style="width: 164px;" readonly placeholder="ID"><br>
                    <span><?php echo $error['id'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="nama">Masukkan Nama:</label></td>
            </tr>
            <tr>
                <td colspan="2"><input type="text" name="nama" value="<?= $nama ?? "" ?>"><br>
                    <span><?php echo $error['nama'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="jenis_k">Pilih Jenis Kelamin:</label></td>
            </tr>
            <tr>
                <td>
                    <select name="jenis_k" style="width: 307px; height: 30px;">
                        <option>Pilih Jenis Kelamin</option>
                        <option value="L">L</option>
                        <option value="P">P</option>
                    </select><br>
                    <span><?php echo $error['jenis_k'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="telp">Masukkan Telepon:</label></td>
            </tr>
            <tr>
                <td><input type="text" name="telp" value="<?= $telp ?? "" ?>"><br>
                    <span><?php echo $error['telp'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="alamat">Masukkan Alamat:</label></td>
            </tr>
            <tr>
                <td><textarea name="alamat"><?php echo $alamat ?? "" ?></textarea><br>
                    <span><?php echo $error['alamat'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="batal" class="batal">Batal</button>
                    <button type="submit" name="update" class="update">Update</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>