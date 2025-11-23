<?php
    include "auth.php";
    include "fungsi.php";
    
    $id_user = $_SESSION['id_user'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];

    if($hasil['level'] != 1) {
        header('location: Tugas-1.php');
    }

    $query = mysqli_query($conn, "SELECT id FROM supplier");
    $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $error = [];
    $error["nama_barang"] = "";
    $error["harga"] = "";
    $error["stok"] = "";

    if(isset($_POST["submit"])) {
        $nama_barang = htmlspecialchars($_POST["nama_barang"]);
        $harga = htmlspecialchars($_POST["harga"]);
        $stok = htmlspecialchars($_POST["stok"]);
        $supplier_id = htmlspecialchars($_POST["supplier_id"]);

        // validasi nama barang
        if(empty($_POST["nama_barang"])) {
            $error["nama_barang"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z]+$/i", $_POST["nama_barang"])) {
            $error["nama_barang"] = "";
        } else {
            $error["nama_barang"] = "Hanya boleh huruf";
        }

        // validasi harga
        if(empty($_POST["harga"])) {
            $error["harga"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[0-9]+$/", $_POST["harga"])) {
            $error["harga"] = "";
        } else {
            $error["harga"] = "Hanya boleh angka";
        }

        // validasi stok
        if(empty($_POST["stok"])) {
            $error["stok"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[0-9]+$/", $_POST["stok"])) {
            $error["stok"] = "";
        } else {
            $error["stok"] = "Hanya boleh angka";
        }

        // apabila benar semua
        if($error["nama_barang"] == "" && $error["harga"] == "" && $error["stok"] == "") {
            $pesan = "Data berhasil disimpan";
            $stmt = $conn->prepare("INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $nama_barang, $harga, $stok, $supplier_id);
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
    <h1>Tambah Barang</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red"><?php echo $error["nama_barang"] ?? ""; ?></p>
            <span>Nama Barang</span>
            <input type="text" name="nama_barang" placeholder="Nama Barang" value="<?php echo $_POST["nama_barang"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["harga"] ?? ""; ?></p>
            <span>Harga</span>
            <input type="text" name="harga" placeholder="Harga" value="<?php echo $_POST["harga"] ?? ""; ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["stok"] ?? ""; ?></p>
            <span>Stok</span>
            <input type="text" name="stok" placeholder="Stok" value="<?php echo $_POST["stok"] ?? ""; ?>">
        </div>
        <div>
            <span>Nama Supplier</span>
            <select name="supplier_id" id="">
                <?php foreach($hasil as $x): ?>
                    <?php 
                        $supplier_id = $x['id'];
                        $query = mysqli_query($conn, "SELECT * FROM supplier WHERE id = $supplier_id");
                        $val = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];
                        ?>
                    <option value="<?php echo $x["id"]; ?>"><?php echo $val["nama"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <input type="submit" value="Simpan" name="submit" class="submit">
            <a href="barang.php" class="batal">Batal</a>
        </div>
    </form>
    <p><?php echo $pesan ?? ""; ?></p>
</body>
</html>