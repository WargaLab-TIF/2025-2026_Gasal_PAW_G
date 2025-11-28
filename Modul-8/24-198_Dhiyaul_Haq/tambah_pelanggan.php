<?php
    include "auth.php";
    include "fungsi.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }

    $error = [];
    $error['nama'] = "";
    $error['jenis_kelamin'] = "";
    $error['telp'] = "";
    $error['alamat'] = "";
    $error['id'] = "";
    if(isset($_POST['submit'])) {
        // validasi id 
        if(empty($_POST["id"])) {
            $error["id"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z0-9]+$/i", $_POST["id"])) {
            $error["id"] = "";
        } else {
            $error["id"] = "Hanya boleh huruf";
        }

        // validasi nama
        if(empty($_POST["nama"])) {
            $error["nama"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z]+$/i", $_POST["nama"])) {
            $error["nama"] = "";
        } else {
            $error["nama"] = "Hanya boleh huruf";
        }

        // validasi telp
        if(empty($_POST["telp"])) {
            $error["telp"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[0-9]+$/", $_POST["telp"])) {
            $error["telp"] = "";
        } else {
            $error["telp"] = "Hanya boleh angka";
        }

        // validasi alamat
        if(empty($_POST["alamat"])) {
            $error["alamat"] = "Tidak boleh kosong";
        } elseif(preg_match("/[a-z]/i", $_POST["alamat"]) && preg_match("/[0-9]/", $_POST["alamat"])) {
            $error["alamat"] = "";
        } else {
            $error["alamat"] = "isian harus alfanumerik";
        }

        // validasi jenis kelamin
        if(empty($_POST["jenis_kelamin"])) {
            $error["jenis_kelamin"] = "Tidak boleh kosong";
        } else {
            $error["jenis_kelamin"] = "";
        }

        if($error['nama'] == "" && $error['telp'] == "" && $error['alamat'] == "" && $error['jenis_kelamin'] == "" && $error['id'] == "") {
            tambahPelanggan(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['nama']), htmlspecialchars($_POST['jenis_kelamin']), htmlspecialchars($_POST['telp']), htmlspecialchars($_POST['alamat']));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <style>
                * {
            font-family: 'Times New Roman';
        }
        body {
            margin: 0;
            text-align: center;
        }
        h1 {
            box-shadow: 2px 2px 5px grey;
            padding: 2vh 0vh;
            margin-top: 0;
            text-align: center;
            box-shadow: 2px 2px 5px grey;
        }
        form {
            width: 100%;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 5%;
        }
        form span {
            margin-right: 1vh;
            text-align: right;
            display: inline-block;
            width: 10vh;
        }
        form div textarea,
        form div select,
        form div input, a {
            width: 30vh;
            border-radius: 10px;
            border: 1px solid grey;
            padding: 1vh;
            box-sizing: border-box;
        }
        form div:has(input[type='radio']) {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20%;
            input {
                margin: 0;
                padding: 0;
                width: 3vh;
                height: 3vh;
            }
            label {
                width: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                span {
                    width: 50%;
                }
            }
        }
        form div:has([type="submit"]) input, a {
            border-radius: 10px;
            color: white;
            border: none;
            box-shadow: 2px 2px 5px grey;
            cursor: pointer;
            width: 10vh;
            text-decoration: none;
        }
        form div:has([type="submit"]) .submit {
            background-color: blueviolet;
        }
        form div:has([type="submit"]) .batal {
            background-color: red;
        }
        form div select {
            text-align: center;
            background-color: white;
        }
    </style>
</head>
<body>
    <h1>Tambah Data Pelanggan</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red"><?php echo $error["id"] ?? ""; ?></p>
            <span>ID Pelanggan</span>
            <input type="text" name="id" placeholder="id Pelanggan" value="<?php echo $_POST["id"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["nama"] ?? ""; ?></p>
            <span>Nama Pelanggan</span>
            <input type="text" name="nama" placeholder="Nama Pelanggan" value="<?php echo $_POST["nama"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["telp"] ?? ""; ?></p>
            <span>No Telp</span>
            <input type="text" name="telp" placeholder="+62 ------ " value="<?php echo $_POST["telp"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["alamat"] ?? ""; ?></p>
            <span>Alamat</span>
            <textarea name="alamat" id="alamat"><?php echo $_POST['alamat'] ?? '' ?></textarea>
        </div>
        <p style="color:red"><?php echo $error["jenis_kelamin"] ?? ""; ?></p>
        <div>
            <span>Jenis Kelamin</span>
            <label for="P">
                <input id="P" type="radio" name="jenis_kelamin" value="P">
                <span>Laki - Laki</span>
            </label>
            <label for="L">
                <input id="L" type="radio" name="jenis_kelamin" value="L">
                <span>Perempuan</span> 
            </label>
        </div>
        <div>
            <input type="submit" value="Simpan" name="submit" class="submit">
            <a href="pelanggan.php" class="batal">Batal</a>
        </div>
    </form>
    <p><?php echo $pesan ?? ""; ?></p>
</body>
</html>