<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("location:beranda.php");
}

$conn = mysqli_connect("localhost", "root", "", "penjualan");
function validateusername(&$error, $field)
{
    $conn = mysqli_connect("localhost", "root", "", "penjualan");
    $query = "SELECT * FROM `user` WHERE username = '$field'";
    $result = mysqli_query($conn, $query);
    if (empty($field)) {
        $error['username'] = "Tidak Boleh Kosong";
    } elseif (mysqli_num_rows($result) == 0) {
        $error['username'] = "Password anda salah";
    }
}
function validatepassword(&$error, $field)
{
    $conn = mysqli_connect("localhost", "root", "", "penjualan");
    $query = "SELECT * FROM `user` WHERE `password` = MD5('$field')";
    $result = mysqli_query($conn, $query);
    if (empty($field)) {
        $error['password'] = "Tidak Boleh Kosong";
    } elseif (mysqli_num_rows($result) == 0) {
        $error['password'] = "Password anda salah";
    }
}

$error = [];
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

$hash = hash("MD5", $password);

if (isset($_POST['login'])) {
    validateusername($error, $username);
    validatepassword($error, $password);

    $query = "SELECT * FROM `user` WHERE username = '$username' AND `password` = '$hash'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        $error['password'] = "Password anda salah";
        $error['username'] = "Username anda salah";
    }
    if (count($error) == 0) {
        $query = "SELECT * FROM `user` WHERE username = '$username' AND `password` = '$hash'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];

            header("location:beranda.php");
        } else {
            header("location:index.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(to right, lightslategray, lightskyblue, lightslategray);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            background-color: lightgray;
            text-align: center;
            padding: 10px;
        }

        table {
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            margin-top: 10px;
            padding: 20px;
        }

        th {
            background-color: lightslategray;
            padding: 10px;
            border-radius: 10px;
        }

        .button {
            width: 305px;
            height: 30px;
            background-color: lightslategray;
            border-radius: 10px;
            color: white;
            border: none;
        }

        .button:hover {
            width: 305px;
            height: 30px;
            background-color: black;
            border-radius: 10px;
            color: lightskyblue;
            border: none;
        }

        input {
            width: 300px;
            height: 30px;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <h2 class="login">Login</h2>
    <div class="container">
        <form action="index.php" method="post">
            <table cellpadding="15px">
                <tr>
                    <th>
                        <label for="username">Masukkan Username:</label>
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="username"><br>
                        <span><?php echo $error['username'] ?? "" ?></span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="password">Masukkan Password:</label>
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="password"><br>
                        <span><?php echo $error['password'] ?? "" ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="login" value="login" class="button">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>