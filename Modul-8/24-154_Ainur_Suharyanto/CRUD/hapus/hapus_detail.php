<?php
include "../../koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM transaksi_detail WHERE transaksi_id='$id'");

header("Location: ../../transaksi/detail_transaksi.php");
exit;
?>