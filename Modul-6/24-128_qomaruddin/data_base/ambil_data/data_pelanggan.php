
<?php
require_once __DIR__. "../../koneksi.php";

$query_select = "SELECT * FROM pelanggan";

$data = $conn->query($query_select);

$dt_pelanggan = [];
while($row = $data->fetch_assoc()){
    $dt_pelanggan[] = $row;
}

?>
