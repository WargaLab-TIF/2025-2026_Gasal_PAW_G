<?php

require_once __DIR__. "../../koneksi.php";

$query_select = "SELECT * FROM transaksi";

$data = $conn->query($query_select);
$ls_transaksi = [];
while($row = $data->fetch_assoc()){
    $ls_transaksi[] = $row;
}

?>