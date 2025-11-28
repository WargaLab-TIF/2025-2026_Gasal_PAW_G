<?php
require "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM supplier WHERE id=$id");
    $data = $result->fetch_assoc();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $sql = "UPDATE supplier SET
                nama= '$nama',    
                telp= '$telp',    
                alamat= '$alamat'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('location: index.php');
    } else {
        echo "Errorrrrr" . $conn->error;
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
    <h2> Edit Data Mahasiswa</h2>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id'] ?? ''; ?>">
        <label>Nama</label><br>
        <input type="text" name="nama" value="<?php echo $data['nama'] ?? ''; ?>"><br><br>
        <label>Telp</label><br>
        <input type="text" name="telp" value="<?php echo $data['telp'] ?? ''; ?>"><br><br>
        <label>Alamat</label><br>
        <input type="text" name="alamat" value="<?php echo $data['alamat'] ?? ''; ?>"><br><br>
        <input type="submit" value="Update" class="simpan">
        <a class="btn-batal" href="index.php">Batal</a>
    </form>
</body>

</html>