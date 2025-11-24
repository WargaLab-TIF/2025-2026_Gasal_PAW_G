<?php
include_once "./header.php";

if (isset($_POST['tambahTr'])) {
    header("location:transaksi.php");
}
if (isset($_POST['tambahTrd'])) {
    header("location:transaksi_detail.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: lightsteelblue;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 600px;
            padding: 100px;
            margin: auto;
            margin-left: 270px;
        }

        .box1 {
            text-align: center;
            background-color: lightgray;
            padding: 40px;
            width: auto;
            margin-right: 50px;
            height: 100px;
            border-radius: 10px;
        }

        .box1 button {
            width: 200px;
            height: 30px;
            border: none;
            border-radius: 10px;
            background-color: lightslategray;
            color: white;
            margin-top: 20px;
        }

        .box1 button:hover {
            width: 200px;
            height: 30px;
            border: none;
            border-radius: 10px;
            background-color: black;
            color: lightskyblue;
            margin-top: 20px;
        }

        .box2 {
            text-align: center;
            width: auto;
            background-color: lightgray;
            padding: 40px;
            margin-left: 50px;
            height: 100px;
            border-radius: 10px;
        }

        .box2 button {
            width: 200px;
            height: 30px;
            background-color: lightgray;
            border: none;
            border-radius: 10px;
            background-color: lightslategray;
            color: white;
        }

        .box2 button:hover {
            width: 200px;
            height: 30px;
            border: none;
            border-radius: 10px;
            background-color: black;
            color: lightskyblue;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" style="display:flex; gap:20px;">
            <div class="box1">
                <h3>Tambahkan Transaksi</h3>
                <button type="submit" name="tambahTr">Tambah Transaksi</button>
            </div>
            <div class="box2">
                <h3>Tambahkan Transaksi Detail</h3>
                <button type="submit" name="tambahTrd">Tambah Transaksi Detail</button>
            </div>
        </form>
    </div>
</body>


</html>