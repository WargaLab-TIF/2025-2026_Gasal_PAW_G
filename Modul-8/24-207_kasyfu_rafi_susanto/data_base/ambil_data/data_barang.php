<?php
require_once __DIR__. "../../koneksi/koneksi.php";

$select_data = "SELECT * FROM barang";
$find_data = $conn->query($select_data);

$ls_barang = [];
while($row = $find_data->fetch_assoc()){
    $ls_barang[] = $row;
}

?>