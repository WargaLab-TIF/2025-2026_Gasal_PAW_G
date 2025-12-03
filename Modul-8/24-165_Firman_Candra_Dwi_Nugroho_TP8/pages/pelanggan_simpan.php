<?php
include "config.php";

$nama = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$telepon = $_POST['no_telp'];

mysqli_query($conn, "INSERT INTO pelanggan (nama_pelanggan, alamat, no_telp)
VALUES ('$nama', '$alamat', '$telepon')");
    
header("Location: index.php?pages=pelanggan");
exit;
?>
