<?php 
require "functions.php";

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($servername, $username, $password, $database);
$id = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM supplier WHERE id = $id");
$row = mysqli_fetch_assoc($query);

$nama = $row["nama"];
$telp = $row["telp"];
$alamat = $row["alamat"];

$errors = [];   


if(isset($_POST["submit"])){
    
    $isNama = validateName($errors, $_POST["nama"]);
    $isTelp = validatePhone($errors, $_POST["telp"]);
    $isAlamat = validateAddress($errors, $_POST["alamat"]);

    if ($isNama && $isTelp && $isAlamat){
        if (update($conn,$_POST, $id) > 0) {
        echo "
            <script> 
            alert('Data berhasil diperbarui');
            document.location.href = 'index.php'
            </script>
        ";
        } else {
        echo "
            <script> 
            alert('Data gagal diperbarui');
            document.location.href = 'index.php'
            </script>
        ";
        };
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Data Master Supplier</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FAF8F5;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            padding: 40px;
            width: 80%;
        }

        h1 {
            text-align: center;
            color: #222222ff;
            margin-bottom: 25px;
        }

        .main {
            background: #ffffffff;
            width: 380px;
            margin: 0 auto;
            border-radius: 15px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: left;
        }
        
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaaaaaff;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            font-weight: 600;
            color: #ffffffff;
            font-size: 14px;
        }

        .submit{
            background-color: #8AC44B;
        }
        .cancel {
            background-color: #FF383C;
        }

        .btn:hover {
            opacity: 0.75;
        }
        
        .error {
            color: #FF383C;
            font-size: 12px;
            margin: 3px 0 10px;
        }

    </style>
</head>
<body>
    <div class="container">
    <h1>Edit Data Master Supplier</h1>
    <div class="main">
    <form action="" method="post">
        <div>
            <label for="nama">Name</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan nama supplier" value="<?= $nama ?? '' ?>">
            <p class="error"><?= $errors["nama"] ?? "" ?></p>
        </div>
        <div>
            <label for="telp">Telepon</label>
            <input type="text" name="telp" id="telp" maxlength="12" placeholder="Masukkan telepon supplier" value="<?= $telp ?? '' ?>">
            <p class="error"><?= $errors["telp"] ?? "" ?></p>
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat supplier" value="<?= $alamat ?? '' ?>">
            <p class="error"><?= $errors["alamat"] ?? "" ?></p>
        </div>
        <div>
            <button class="btn submit" type="submit" name="submit" onclick="return confirm('Yakin ingin memperbarui data?')">Update</button>
            <button type="button" class="btn cancel" onclick="window.location.href='index.php'">Batal</button>
        </div>
    </form>
    </div>
    </div>
</body>
</html>