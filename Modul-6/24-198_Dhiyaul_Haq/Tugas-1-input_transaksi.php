<?php
    include "fungsi.php";
    
    // array untuk menyimpan error
    $msg = [];
    $msg['waktu_transaksi'] = "";
    $msg['keterangan'] = "";
    
    if (isset($_POST['submit'])) {

        // panggil fungsi
        validateDate($_POST['waktu_transaksi'], $msg);
        validateKeterangan($_POST['keterangan'], $msg);        

        // jika tidak ada error pada waktu_transaksi dan keterangan
        if ($msg['waktu_transaksi'] == "" && $msg['keterangan'] == "") {
            tambahTransaksi($_POST['waktu_transaksi'], $_POST['keterangan'], $_POST['total'], $_POST['pelanggan_id']);
            header("location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
        textarea,
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
    <h1>Tambah Transaksi</h1>
    <form action="" method="POST">
        <span>Waktu Transaksi</span>
        <p style="color:red" ><?php echo $msg["waktu_transaksi"] ?></p>
        <input type="date" name="waktu_transaksi" value="<?php echo $_POST['waktu_transaksi'] ?? "" ?>">
        <span>Keterangan</span>
        <p style="color:red"><?php echo $msg["keterangan"] ?></p>
        <textarea name="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi" ><?php echo $_POST['keterangan'] ?? "" ?></textarea>
        <span>Total</span>
        <input type="text" name="total" value="<?php
            if (empty($_POST['total'])) {
                echo 0;
            } else {
                echo $_POST['total'];
            }
        ?>">
        <span>Pelanggan ID</span>
        <select name="pelanggan_id" >
            <?php foreach($data_pelanggan as $data): ?>
                <?php if ($_POST['pelanggan_id'] == $data['id']): ?>
                    <option value="<?php echo $data['id'] ?>" selected ><?php echo $data['id'] ?></option>
                <?php else: ?>
                    <option value="<?php echo $data['id'] ?>"><?php echo $data['id'] ?></option>
                <?php endif; ?>        
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>