<?php
require_once __DIR__. "../../koneksi/koneksi.php";

$select_data = "SELECT * FROM supplier";
$find_data = $conn->query($select_data);

$ls_supplier = [];
while($row = $find_data->fetch_assoc()){
    $ls_supplier[] = $row;
}

?>