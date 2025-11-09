<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT id FROM barang";
$return = mysqli_query($conn, $query);
$barang = mysqli_fetch_all($return, MYSQLI_ASSOC);

$query = "SELECT id FROM transaksi";
$return = mysqli_query($conn, $query);
$pelanggan_id = mysqli_fetch_all($return, MYSQLI_ASSOC);
function validateQty(&$error, $field)
{

    if (empty($field)) {
        $error['quantity'] = "Jangan kosong";
    } elseif (!preg_match("/^[0-9]+$/", $field)) {
        $error['quantity'] = "Hanya boleh angka";
    }
}
function validateTrans(&$error, $barang_id, $transaksi_id)
{
    $conn = mysqli_connect("localhost", "root", "", "penjualan");
    $query = "SELECT * FROM transaksi_detail WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)) {
        $error['quantity'] = "transaksi tersebut sudah ada";
    }
}
$error = [];
$qty = $_POST['quantity'] ?? "";
$barang_id = $_POST['barang'] ?? "";
$transaksi_id = $_POST['id_transaksi'] ?? "";
if (isset($_POST['tambah'])) {
    validateQty($error, $qty);
    validateTrans($error, $barang_id, $transaksi_id);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Detail</title>
    <style>
        h2 {
            background-color: lightcyan;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }
        table {
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0px 4px 20px black;
            border-radius: 10px;
            padding: 10px;
        }
        .tambah {
            background-color: lightseagreen;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }
        .tambah:hover {
            background-color: white;
            color: lightseagreen;
            padding: 10px;
            border-radius: 10px;
        }
        span {
            color: red;
        }
        label {
            color: lightseagreen;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Tambah Detail Transaksi</h2><br>
    <form action="transaksi_detail.php" method="post">

        <table border="0">
            <tr>
                <td><label for="barang" style="text-align: left;">Pilih Barang</label></td>
            </tr>
            <tr>
                <td>
                    <select name="barang" style="width: 304px; height:30px;">
                        <?php foreach ($barang as $b): ?>
                            <option value="<?= $b['id'] ?>"><?= $b['id'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td><label for="id_transaksi" style="text-align: left;">ID Transaksi</label></td>
            </tr>
            <tr>
                <td>
                    <select name="id_transaksi" style="width: 304px; height:30px;">
                        <?php foreach ($pelanggan_id as $pi): ?>
                            <option value="<?= $pi['id'] ?>"><?= $pi['id'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td><label for="quantity" style="text-align: left;">Quantity</label></td>
            </tr>
            <tr>
                <td><input type="text" name="quantity" value="<?= $qty ?? "" ?>" style="width: 297px; height:30px;" placeholder="Masukkan jumlah barang"></td>
            </tr>
            <tr>
                <td><span><?php echo $error['quantity'] ?? "" ?></span></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td><input type="submit" name="tambah" value="Tambah Detail Transaksi" style="width: 304px;" class="tambah"></td>
            </tr>
        </table>
    </form>
</body>

</html>
<?php
if (isset($_POST['tambah'])) {
    if (count($error) == 0) {
        $transaksi_id = $_POST['id_transaksi'];
        $barang_id = $_POST['barang'];
        $qty = $_POST['quantity'];

        $query = "SELECT harga FROM barang WHERE id = $barang_id";
        $result = mysqli_query($conn, $query);
        $harga = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_harga = (int)$harga[0]['harga'] * (int)$qty;

        $query = "SELECT * FROM transaksi WHERE id = $transaksi_id";
        $result = mysqli_query($conn, $query);
        $transaksi = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $list_pelangggan = [];
        foreach ($transaksi as $id) {
            $idP = $id['pelanggan_id'];
            $query = "SELECT total FROM transaksi WHERE pelanggan_id = '$idP'";
            $result2 = mysqli_query($conn, $query);
            $nama = mysqli_fetch_assoc($result2);
            $list_pelangggan[$idP] = $nama['total'];
        }

        $id_pelanggan = $transaksi[0]['pelanggan_id'];
        $total = $list_pelangggan[$id_pelanggan];
        $updateTotal = $total + $total_harga;
        $query = "UPDATE transaksi SET `total`='$updateTotal' WHERE pelanggan_id = '$id_pelanggan'";
        $result = mysqli_query($conn, $query);
        $query = "INSERT INTO transaksi_detail(transaksi_id,barang_id,harga,qty) VALUES ('$transaksi_id','$barang_id','$total_harga','$qty')";

        if (mysqli_query($conn, $query)) {
            header("location:index.php");
        }
    }
}

?>