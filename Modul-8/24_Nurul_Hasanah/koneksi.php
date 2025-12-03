<?php

$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

if(mysqli_connect_errno()){
    echo "Gagal konek ke database: " . mysqli_connect_error();
}

?>