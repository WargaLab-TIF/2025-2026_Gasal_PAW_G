<?php
require_once __DIR__. "../../koneksi/koneksi.php";

$select_data = "SELECT * FROM pelanggan";
$find_data = $conn->query($select_data);

$ls_pelanggan = [];
while($row = $find_data->fetch_assoc()){
    $ls_pelanggan[] = $row;
}

?>