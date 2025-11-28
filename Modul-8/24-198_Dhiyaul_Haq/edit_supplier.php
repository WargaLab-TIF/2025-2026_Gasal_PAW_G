<?php
    include "auth.php";
    include "fungsi.php";

    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }

    $id_user = (int)htmlspecialchars($_GET['id']);
    $hasil = EditSupplier($id_user);
    $error = [];
    if(isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];
        
        // validasi nama
        if(empty($_POST["nama"])) {
            $error["nama"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z\s]+$/i", $_POST["nama"])) {
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
            $nama = htmlspecialchars($_POST['nama']);
            $telp = htmlspecialchars($_POST['telp']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $query = $conn->prepare("UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = $id_user");
            $query->bind_param("sss", $nama, $telp, $alamat);
            $query->execute();
            $query->close();
            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Supplier</title>
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
        form select {
            text-align: center;
            background-color: white;
        }
        form div:has([type="submit"]) .submit {
            background-color: blueviolet;
        }
        form div:has([type="submit"]) .batal {
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Edit Supplier</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red"><?php echo $error["nama"] ?? ""; ?></p>
            <span>Nama: </span>
            <input type="text" name="nama" value="<?php echo $_POST['nama'] ?? $hasil['nama'] ?>" required>
        </div>
        <div>
            <p style="color:red"><?php echo $error["telp"] ?? ""; ?></p>
            <span>No Telp:</span>
            <input type="text" name="telp" value="<?php echo $_POST['telp'] ?? $hasil['telp'] ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["alamat"] ?? ""; ?></p>
            <span>Alamat:</span>
            <textarea name="alamat" id="alamat"><?php echo $_POST['alamat'] ?? $hasil['alamat'] ?></textarea>
        </div>
        <div>
            <input type="submit" value="submit" name="submit" class="submit">
            <a href="supplier.php" class="batal">Batal</a>
        </div>
    </form>
</body>
</html>