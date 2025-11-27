<?php

require_once __DIR__. "../../koneksi/koneksi.php";
$id = $_GET["id"];

$query_delet = "DELETE FROM barang WHERE id='$id'";
if($conn->query($query_delet)){
    header("location:../../tampilan/admin/data_master.php");
}

?>