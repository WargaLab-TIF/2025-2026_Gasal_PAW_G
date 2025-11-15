<?php
    include "fungsi.php";

    $msg = [];
    $msg['barang_id'] = "";
    $msg['qty'] = "";

    if (isset($_POST['submit'])) {
        validateBarang($_POST['transaksi_id'],$_POST['barang_id'], $msg);
        validateQty($_POST['qty'], $msg);

        if ($msg['barang_id'] == "" && $msg['qty'] == "") {
            tambahDetailTransaksi($_POST['barang_id'], $_POST['transaksi_id'], $_POST['qty']);
            update($data_transaksi_detail);
            header("location: index.php");
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
            margin: 0;
            padding: 0;
        } 
        h1 {
            text-align: center;
            padding: 1vh 0vh;
            box-shadow: 2px 2px 5px grey;
        }
        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 20%;
            margin: auto;
            height: 90vh;
        }
        select,
        input:not([type="submit"]) {
            border: 1px solid grey;
            border-radius: 10px;
            width: 100%;
            padding: 1vh 0vh;
            margin-bottom: 3vh;
            margin-top: 1vh;
            background-color: white;
            text-align: justify;
        }
        input[name="submit"] {
            border: none;
            background-color: blueviolet;
            color: aliceblue;
            padding: 1vh 2vh;
            border-radius: 10px;
            margin-top: 1vh;
            transition: 0.2s ease-in-out;
            cursor: pointer;
        }
        input[name="submit"]:hover {
            box-shadow: 2px 2px 5px grey;
            transform: translateY(-0.5vh);
        }
    </style>
</head>
<body>
    <h1>Tambah Detail Transaksi</h1>
    <form action="" method="POST">
        <span>Pilih Barang</span>
        <p style="color:red" ><?php echo $msg["barang_id"] ?></p>
        <select name="barang_id" >
            <?php foreach($data_barang as $data): ?>
                <?php if ($_POST['barang_id'] == $data['id']): ?>
                    <option value="<?php echo $data['id'] ?>" selected ><?php echo $data['id'] ?></option>
                <?php else: ?>
                    <option value="<?php echo $data['id'] ?>"><?php echo $data['id'] ?></option>
                <?php endif; ?>        
            <?php endforeach; ?>
        </select>
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
        <span>Quantity</span>
        <p style="color:red" ><?php echo $msg["qty"] ?></p>
        <input type="text" name="qty" value="<?php echo $_POST['qty'] ?? ""; ?>" placeholder="Masukkan jumlah barang">
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>