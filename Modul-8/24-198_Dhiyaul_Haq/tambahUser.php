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
    $error['username'] = "";
    $error['password'] = "";
    $error['nama'] = "";
    $error['hp'] = "";
    $error['alamat'] = "";
    if(isset($_POST['submit'])) {
        // validasi username
        if(empty($_POST["username"])) {
            $error["username"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z\s0-9]{2,}$/i", $_POST["username"])) {
            $error["username"] = "";
        } else {
            $error["username"] = "Harus lebih dari 2 karakter";
        }
        
        // validasi password
        if(empty($_POST["password"])) {
            $error["password"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z\s0-9]{8,}$/i", $_POST["password"])) {
            $error["password"] = "";
        } else {
            $error["password"] = "Harus lebih dari 8 karakter";
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
        if(empty($_POST["hp"])) {
            $error["hp"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[0-9]+$/", $_POST["hp"])) {
            $error["hp"] = "";
        } else {
            $error["hp"] = "Hanya boleh angka";
        }

        // validasi alamat
        if(empty($_POST["alamat"])) {
            $error["alamat"] = "Tidak boleh kosong";
        } elseif(preg_match("/[a-z]/i", $_POST["alamat"]) && preg_match("/[0-9]/", $_POST["alamat"])) {
            $error["alamat"] = "";
        } else {
            $error["alamat"] = "isian harus alfanumerik";
        }

        if($error['nama'] == "" && $error['hp'] == "" && $error['alamat'] == "" && $error['username'] == "" && $error['password'] == "") {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $nama = htmlspecialchars($_POST['nama']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $hp = htmlspecialchars($_POST['hp']);
            $level = $_POST['level'];   
            $query = $conn->prepare("INSERT INTO user (username, password, nama, alamat, hp, level)
            VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param("ssssss", $username, md5($password), $nama, $alamat, $hp, $level);
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
    <title>Tambah User</title>
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
            height: 70vh;
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
    <h1>Tambah User Baru</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red"><?php echo $error["username"] ?? ""; ?></p>
            <span>Username: </span>
            <input type="text" name="username" required value="<?php echo $_POST['username'] ?? '' ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["password"] ?? ""; ?></p>
            <span>Password:</span>
            <input type="password" name="password" required value="<?php echo $_POST['password'] ?? '' ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["nama"] ?? ""; ?></p>
            <span>Nama:</span>
            <input type="text" name="nama" value="<?php echo $_POST['nama'] ?? '' ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["alamat"] ?? ""; ?></p>
            <span>Alamat:</span>
            <textarea name="alamat" id="alamat"><?php echo $_POST['alamat'] ?? '' ?></textarea>
        </div>
        <div>
            <p style="color:red"><?php echo $error["hp"] ?? ""; ?></p>
            <span>Nomor HP:</span>
            <input type="text" name="hp" value="<?php echo $_POST['hp'] ?? '' ?>">
        </div>
        <div>
            <span>Jenis User:</span>
            <select name="level" id="level">
                <?php if($_POST['level'] == ""): ?>
                    <option value="1">Owner</option>
                    <option value="2" selected >Kasir</option>
                <?php else: ?>
                    <?php if($_POST['level'] == 1): ?>
                        <option value="1" selected >Owner</option>
                        <option value="2">Kasir</option>
                    <?php else: ?>
                        <option value="1">Owner</option>
                        <option value="2" selected >Kasir</option>
                    <?php endif; ?>
                <?php endif; ?>
            </select>
        </div>
        <div>
            <input type="submit" value="submit" name="submit" class="submit">
            <a href="user.php" class="batal">Batal</a>
        </div>
    </form>
</body>
</html>