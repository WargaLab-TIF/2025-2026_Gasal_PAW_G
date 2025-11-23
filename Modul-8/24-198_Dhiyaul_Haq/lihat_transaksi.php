<?php
    include "auth.php";
    include "fungsi.php";
    
    $id_user = (int)htmlspecialchars($_GET['id']);
    $hasil = LihatTransaksi($id_user);
    $stmt = $conn->prepare("SELECT pelanggan.nama, transaksi.total, transaksi.keterangan, transaksi.waktu_transaksi 
                            FROM transaksi
                            INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
                            WHERE transaksi.id = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $info = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
    </style>
</head>
<body>
    <h1>Lihat Transaksi</h1>
    <div class="transaksi">
        <a href="transaksi.php">Kembali</a>
        <div>
            <div>
                <p>Nama:</p>
                <p><?php echo $info['nama'] ?>asd</p>
            </div>
            <div>
                <p>Total:</p>
                <p><?php echo $info['total'] ?></p>
            </div>
            <div>
                <p>Keterangan:</p>
                <p><?php echo $info['keterangan'] ?></p>
            </div>
            <div>
                <p>Waktu Transaksi:</p>
                <p><?php echo $info['waktu_transaksi'] ?></p>
            </div>
        </div>
        <h1>List Barang</h1>
        <div>
            <?php if($hasil): ?>
                <?php foreach($hasil as $h): ?>
                    <div>
                        <p><?php echo $h['nama_barang'] ?></p>
                        <hr>
                        <p>Harga</p>
                        <p><?php echo $h['harga'] ?></p>
                        <hr>
                        <p>Qty</p>
                        <p><?php echo $h['qty'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Kosong</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>