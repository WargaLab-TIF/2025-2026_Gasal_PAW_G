<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location:../../index.php");
}

$conn = mysqli_connect("localhost", "root", "", "penjualan");
function validateusername(&$error, $field)
{
    if (empty($field)) {
        $error['username'] = "Tidak Boleh Kosong";
    }
}
function validatepassword(&$error, $field)
{
    if (empty($field)) {
        $error['password'] = "Tidak Boleh Kosong";
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

$id = $_GET['id'] ?? "";
$query = "SELECT * FROM `user` WHERE id_user='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$error = [];
$username = $data['username'] ?? "";
$password = $data['password'] ?? "";
$nama = $data['nama'] ?? "";
$telp = $data['hp'] ?? "";
$alamat = $data['alamat'] ?? "";
$level = $data['level'] ?? "";

$lev = "";
if($level == 1){
    $lev = "admin";
}elseif($level == 2){
    $lev = "user";
}

if (isset($_POST['update'])) {
    $id = htmlspecialchars($_GET['id'] ?? "");
    $username = htmlspecialchars($_POST['username'] ?? "");
    $password = htmlspecialchars($_POST['password'] ?? "");
    $nama = htmlspecialchars($_POST['nama'] ?? "");
    $telp = htmlspecialchars($_POST['telp'] ?? "");
    $alamat = htmlspecialchars($_POST['alamat'] ?? "");
    $level = htmlspecialchars($_POST['level'] ?? "");
    if ($level == 1) {
        $lev = "admin";
    } elseif ($level == 2) {
        $lev = "user";
    }
    
    validateusername($error, $username);
    validatepassword($error, $password);
    validatenama($error, $nama);
    validatetelp($error, $telp);
    validatealamat($error, $alamat);

    if (count($error) == 0) {
        $query = "UPDATE `user` SET username = ?,`password` = ?,nama = ?,hp = ?,alamat = ?,`level` = ? WHERE id_user = ?";
        $prepare = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($prepare,"sssssii",$username,$password,$nama,$telp,$alamat,$level,$id);
        if (mysqli_stmt_execute($prepare)) {
            header("location:../../user.php");
        } else {
            echo "Data gagal ditambahkan";
        }
    }
}
if (isset($_POST['batal'])) {
    header("location:../../user.php");
}



$query = "SELECT `level` FROM `user` WHERE `level` != '$level' GROUP BY `level`";
$result = mysqli_query($conn,$query);
$nlevel = mysqli_fetch_array($result);
$nlev = "";
if ($nlevel['level'] == 1) {
    $nlev = "admin";
} elseif ($nlevel['level'] == 2) {
    $nlev = "user";
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
    <h2>Tambah Data User</h2>
    <form action="eduser.php?id=<?= $id ?>" method="post">
        <table border="0">
            <tr>
                <td><label for="username">Masukkan Username:</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="username" value="<?= $username ?? "" ?>"><br>
                    <span><?php echo $error['username'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="password">Masukkan Password:</label></td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password" value="<?= $password ?>"><br>
                    <span><?php echo $error['password'] ?? "" ?></span>
                </td>
            </tr>
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
                <td><label for="level">Pilih Level</label></td>
            </tr>
            <tr>
                <td>
                    <select name="level" style="width: 307px; height: 30px;">
                        <option value="<?= $level ?>"><?php echo $lev?></option>
                        <option value="<?= $nlevel['level'] ?>"><?php echo $nlev?></option>
                    </select><br>
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