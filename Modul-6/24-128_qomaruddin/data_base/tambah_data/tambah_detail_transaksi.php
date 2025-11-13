
<?php
require_once __DIR__. "../../koneksi.php";

$select_harga = "SELECT harga FROM barang WHERE nama_barang = '$barang'";
$data = $conn->query($select_harga);
$row = $data->fetch_assoc();
$harga = $row["harga"]*$quantity;

$query_insert = "INSERT INTO transaksi_detail(transaksi_id,barang_id,harga,qty) VALUES('$id_transaksi','$id',$harga,'$quantity')";
if($conn->query($query_insert)){
    header("location:.././index.php");
}

?>
