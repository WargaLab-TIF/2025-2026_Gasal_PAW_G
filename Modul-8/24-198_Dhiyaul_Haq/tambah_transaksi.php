<?php
    include "fungsi.php";
    include "auth.php";

    // array untuk menyimpan error
    $msg = [];
    $msg['waktu_transaksi'] = "";
    $msg['keterangan'] = "";
    
    if (isset($_POST['submit'])) {

        // panggil fungsi
        validateDate(htmlspecialchars($_POST['waktu_transaksi']), $msg);
        validateKeterangan(htmlspecialchars($_POST['keterangan']), $msg);        

        // jika tidak ada error pada waktu_transaksi dan keterangan
        if ($msg['waktu_transaksi'] == "" && $msg['keterangan'] == "") {
            tambahTransaksi(htmlspecialchars($_POST['waktu_transaksi']), htmlspecialchars($_POST['keterangan']), htmlspecialchars($_POST['total']), htmlspecialchars($_POST['pelanggan_id']));
            header("location: transaksi.php");
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
            width: 15vh;
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
    <h1>Tambah Transaksi</h1>
    <form action="" method="POST">
        <div>
            <p style="color:red" ><?php echo $msg["waktu_transaksi"] ?></p>
            <span>Waktu Transaksi</span>
            <input type="date" name="waktu_transaksi" value="<?php echo $_POST['waktu_transaksi'] ?? "" ?>">
        </div>
        <div>
            <p style="color:red"><?php echo $msg["keterangan"] ?></p>
            <span>Keterangan</span>
            <textarea name="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi" ><?php echo $_POST['keterangan'] ?? "" ?></textarea>
        </div>
        <div>
            <span>Total</span>
            <input type="number" name="total" value="0" disabled>
        </div>
        <div>
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
        </div>
        <div>
            <input type="submit" name="submit" value="submit" class="submit">
            <a href="transaksi.php" class="batal">Batal</a>
        </div>
    </form>
</body>
</html>