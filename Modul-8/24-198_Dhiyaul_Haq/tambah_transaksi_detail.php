<?php
    include "fungsi.php";
    include "auth.php";

    $msg = [];
    $msg['barang_id'] = "";
    $msg['qty'] = "";

    if (isset($_POST['submit'])) {
        validateBarang(htmlspecialchars($_POST['transaksi_id']),htmlspecialchars($_POST['barang_id']), $msg);
        validateQty(htmlspecialchars($_POST['qty']), htmlspecialchars($_POST['barang_id']), $msg);

        if ($msg['barang_id'] == "" && $msg['qty'] == "") {
            tambahDetailTransaksi(htmlspecialchars($_POST['barang_id']), htmlspecialchars($_POST['transaksi_id']), htmlspecialchars($_POST['qty']));
            update($data_transaksi_detail);
            header("location: transaksi.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
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
    <h1>Tambah Detail Transaksi</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red" ><?php echo $msg["barang_id"] ?></p>
            <span>Pilih Barang</span>
            <select name="barang_id" >
                <?php foreach($data_barang as $data): ?>
                    <?php if ($_POST['barang_id'] == $data['id']): ?>
                        <option value="<?php echo $data['id'] ?>" selected ><?php echo $data['nama_barang'] ?></option>
                    <?php else: ?>
                        <option value="<?php echo $data['id'] ?>"><?php echo $data['nama_barang'] ?></option>
                    <?php endif; ?>        
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <span>ID Transaksi</span>
            <select name="transaksi_id" >
                <?php foreach($data_transaksi as $data): ?>
                    <?php if ($_POST['transaksi_id'] == $data['id']): ?>
                        <option value="<?php echo $data['id'] ?>" selected ><?php echo $data['id'] ?></option>
                    <?php else: ?>
                        <option value="<?php echo $data['id'] ?>"><?php echo $data['id'] ?></option>
                    <?php endif; ?>        
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <p style="color:red" ><?php echo $msg["qty"] ?></p>
            <span>Quantity</span>
            <input type="text" name="qty" value="<?php echo $_POST['qty'] ?? ""; ?>" placeholder="Masukkan jumlah barang">
        </div>
        <div>
            <input type="submit" name="submit" value="submit" class="submit">
            <a href="transaksi.php" class="batal">Batal</a>
        </div>
    </form>
</body>
</html>