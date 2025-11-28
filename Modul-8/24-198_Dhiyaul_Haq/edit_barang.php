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
    $hasil = EditBarang($id_user);
    $error = [];
    $error["nama_barang"] = "";
    $error["harga"] = "";
    $error["stok"] = "";

    if(isset($_POST["submit"])) {
        $nama_barang = $_POST["nama_barang"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];
        $supplier_id = htmlspecialchars($_POST["supplier_id"]);

        // validasi nama barang
        if(empty($_POST["nama_barang"])) {
            $error["nama_barang"] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z\s]+$/i", $_POST["nama_barang"])) {
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

        if($error["nama_barang"] == "" && $error["harga"] == "" && $error["stok"] == "") {
            $nama_barang = htmlspecialchars($_POST['nama_barang']);
            $harga = htmlspecialchars($_POST['harga']);
            $stok = htmlspecialchars($_POST['stok']);
            $supplier_id = $_POST['supplier_id'];
            $query = $conn->prepare("UPDATE barang SET nama_barang = ?, harga = ?, stok = ?, supplier_id = ? WHERE id = $id_user");
            $query->bind_param("siii", $nama_barang, $harga, $stok, $supplier_id);
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
    <h1>Edit Barang</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red"><?php echo $error["nama_barang"] ?? ""; ?></p>
            <span>Nama Barang: </span>
            <input type="text" name="nama_barang" value="<?php echo $_POST['nama_barang'] ?? $hasil['nama_barang'] ?>" required>
        </div>
        <div>
            <p style="color:red"><?php echo $error["harga"] ?? ""; ?></p>
            <span>Harga:</span>
            <input type="number" name="harga" value="<?php echo $_POST['harga'] ?? $hasil['harga'] ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $error["stok"] ?? ""; ?></p>
            <span>Stok:</span>
            <input type="number" name="stok" value="<?php echo $_POST['stok'] ?? $hasil['stok'] ?>">
        </div>
        <div>
            <span>Supplier ID:</span>
            <select name="supplier_id" id="supplier_id">
                <?php if($_POST['supplier_id'] == ""): ?>
                    <?php foreach($data_supplier as $d): ?>
                        <?php if($d['id'] == $hasil['supplier_id']): ?>
                            <option value="<?php echo $d['id'] ?>" selected><?php echo $d['nama'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach($data_supplier as $d): ?>
                        <?php if($_POST['supplier_id'] == $d['id']): ?>
                            <option value="<?php echo $d['id'] ?>" selected><?php echo $d['nama'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div>
            <input type="submit" value="submit" name="submit" class="submit">
            <a href="barang.php" class="batal">Batal</a>
        </div>
    </form>
</body>
</html>