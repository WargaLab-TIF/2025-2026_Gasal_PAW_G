<?php 
$mysqli= new mysqli("localhost","root","Ryan2025","penjualan");
if(!$mysqli){
    echo "Koneksi Gagal". mysqli_connect_error();
}