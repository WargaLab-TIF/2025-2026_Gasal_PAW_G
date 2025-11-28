<?php
include "koneksi.php";

$nama = $telp = $alamat ="";
$errName = $errTelp = $errAlamat = "";
$valid = True;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST["nama"];
    $telp = trim($_POST["telp"]); // trim = menghapus spasi
    $alamat = trim($_POST["alamat"]);


    //validasi nama
    if (empty($nama)) {
        $errName = "Nama tidak boleh kosong";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $errName = "Nama hanya boleh berisi huruf dan spasi";
        $valid = False;
    }

    //validasi telp
    if (empty($telp)) {
        $errTelp = "Nomor telepon tidak boleh kosong";
        $valid = False ;
    } elseif (!preg_match("/^[0-9]+$/" , $telp)) {
        $errTelp  = "Nomor hanya boleh angka ";
        $valid = false;
    }

    //validasi alamat
    if (empty($alamat)) {
        $errAlamat = "Alamat tidak boleh kosong";
        $valid = false;
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$/" , $alamat)) {
        $errAlamat = "Alamat  harus alfanumerik (minimal harus ada 1 angka dan 1 huruf)";
        $valid = false;
    }




    if ($valid){
        $query = "INSERT INTO supplier (nama,telp,alamat) VALUES ('$nama','$telp','$alamat')";

        if (mysqli_query($conn, $query)) {
            header('location: index.php');
        }else {
            echo "Gagal menyimpan data : ". mysqli_error($conn);
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
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 40px;
        }

        h2 {
            color: #3498db;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container {
            background-color: #fff;
            width: 400px;
            margin: auto;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 2px;
        }


        input[type="text"] {
            width: 50%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
           
        }

        .simpan {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 8px;
        }

        .simpan:hover {
            background-color: #1e8449; //*hover : ketika di kursor di arahkan maka akan berubah warna*/ 
        }

        .btn-batal {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-batal:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tambah Data Master Supplier baru</h2>
        <form action="tambahData.php" method="post">
            <label for="">Nama</label> <br>
            <input type="text" name="nama" value="<?=$nama ?? ''?>"> <br>
            <div class="eror"><?php echo $errName;?></div>

            <label for="">Telp</label> <br>
            <input type="text" name="telp" value="<?=$telp ?? ''?> "> <br>
            <div class="eror"><?php echo $errTelp; ?></div>

            <label for="">alamat</label> <br>
            <input type="text" name="alamat" value="<?=$alamat ?? ''?>"> <br>
            <div class="eror"><?php echo $errAlamat; ?></div>

            <div class="tombol">
                <button type="submit" class="simpan">Simpan</button>
                <a class="btn-batal" href="index.php">Batal</a>
            </div>
    </div>
    </form>
</body>

</html>

