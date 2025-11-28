<?php
    include "conn.php";
    include "fungsi.php";
    include "auth.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }

    $error = [];
    if(isset($_POST["submit"])) {
        $nama = htmlspecialchars($_POST["nama"]);
        $telp = htmlspecialchars($_POST["telp"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        
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

        // apabila benar semua
        if($error["nama"] == "" && $error["telp"] == "" && $error["alamat"] == "") {
            $pesan = "Data berhasil disimpan";
            $stmt = $conn->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $telp, $alamat);
            $stmt->execute();
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
            height: 50vh;
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
        form div select,
        form div input, a {
            width: 30vh;
            border-radius: 10px;
            border: 1px solid grey;
            padding: 1vh;
            box-sizing: border-box;
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
    <h1>Tambah Supplier </h1>
    <form action="" method="POST">
        <div>
            <p style="color:red"><?php echo $error["nama"] ?? ""; ?></p>
            <span>Nama</span>
            <input type="text" name="nama" placeholder="Nama" value="<?php echo $_POST["nama"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["telp"] ?? ""; ?></p>
            <span>Telp</span>
            <input type="text" name="telp" placeholder="Telp" value="<?php echo $_POST["telp"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["alamat"] ?? ""; ?></p>
            <span>Alamat</span>
            <input type="text" name="alamat" placeholder="Alamat" value="<?php echo $_POST["alamat"] ?? ""; ?>">
        </div>
        <div>
            <input type="submit" value="Simpan" name="submit" class="submit">
            <a href="supplier.php" class="batal">Batal</a>
        </div>
    </form>
    <p><?php echo $pesan ?? ""; ?></p>
</body>
</html>