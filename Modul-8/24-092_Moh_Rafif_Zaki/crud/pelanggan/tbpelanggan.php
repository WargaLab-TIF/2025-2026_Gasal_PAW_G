<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location:../../index.php");
}

$conn = mysqli_connect("localhost", "root", "", "penjualan");
function validateid(&$error, $field)
{   
    $conn = mysqli_connect("localhost", "root", "", "penjualan");
    $query = "SELECT * FROM pelanggan WHERE id = '$field'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)){
        $error['id'] = "ID ini sudah ada";
    }elseif (empty($field)) {
        $error['id'] = "Tidak Boleh Kosong";
    } elseif (!preg_match("/^[0-9\s'-]+$/", substr($field,14))) {
        $error['id'] = 'Hanya boleh angka';
    }
}

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
    }elseif(strlen($field) < 11 || strlen($field) > 13){
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



$idpl = htmlspecialchars($_POST['idpl'] ?? "");  
$idtg = htmlspecialchars($_POST['idtg'] ?? "");  
$id = htmlspecialchars($_POST['id'] ?? "");  

$error = [];
$idgab = htmlspecialchars(($idpl.$idtg.$id) ?? "");
$nama = htmlspecialchars($_POST['nama'] ?? "");
$jenis_k = htmlspecialchars($_POST['jenis_k'] ?? "");
$telp = htmlspecialchars($_POST['telp'] ?? "");
$alamat = htmlspecialchars($_POST['alamat'] ?? "");
if (isset($_POST['tambah'])) {
    validateid($error,$idgab);
    validatenama($error, $nama);
    validatetelp($error, $telp);
    validatealamat($error, $alamat);
    validateJK($error, $jenis_k);
    if (count($error) == 0) {
        $query = "INSERT INTO pelanggan (id,nama,jenis_kelamin,telp,alamat) VALUES (?,?,?,?,?)";
        $prepare = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($prepare,"sssss",$idgab,$nama,$jenis_k,$telp,$alamat);
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

date_default_timezone_set("ASIA/Makassar");
$idtg = str_replace(" ", "",date("Y m d"));
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

        .tambah {
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
            border: none;

        }

        .tambah:hover {
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
    <form action="tbpelanggan.php" method="post">
        <table border="0">
            <tr>
                <td><label for="id">Masukkan ID:</label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="idpl" value="PLG" readonly style="width: 35px;">
                    <input type="text" name="idtg" value="<?= $idtg ?? "" ?>ZXA" readonly style="width: 93px;">
                    <input type="text" name="id" value="<?= $id ?>" style="width: 164px;" placeholder="ID"><br>
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
                    <button type="submit" name="tambah" class="tambah">Tambah</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>