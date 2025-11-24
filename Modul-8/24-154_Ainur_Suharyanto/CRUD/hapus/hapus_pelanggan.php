<?php
include "../../koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id='$id'");
header("Location: ../../data_pelanggan.php");
?>