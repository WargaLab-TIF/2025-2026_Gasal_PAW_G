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

$error = [];
$nama = htmlspecialchars($_POST['nama'] ?? "");
$telp = htmlspecialchars($_POST['telp'] ?? "");
$alamat = htmlspecialchars($_POST['alamat'] ?? "");
if (isset($_POST['tambah'])) {
    validatenama($error, $nama);
    validatetelp($error, $telp);
    validatealamat($error, $alamat);
    if (count($error) == 0) {
        $query = "INSERT INTO supplier (nama,telp,alamat) VALUES (?,?,?)";
        $prepare = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($prepare,"sss",$nama,$telp,$alamat);

        if (mysqli_stmt_execute($prepare)) {
            header("location:../../supplier.php");
        } else {
            echo "Data gagal ditambahkan";
        }
    }
}
if (isset($_POST['batal'])) {
    header("location:../../supplier.php");
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
    <h2>Tambah Data Supplier</h2>
    <form action="tbsupplier.php" method="post">
        <table>
            <tr>
                <td><label for="nama">Masukkan Nama:</label></td>
            </tr>
            <tr>
                <td><input type="text" name="nama" value="<?= $nama ?? "" ?>"><br>
                    <span><?php echo $error['nama'] ?? "" ?></span>
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