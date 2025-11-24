<?php
include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id'";
$query = mysqli_query($conn, $sql);

if($query){
    header("Location: index.php?pages=pelanggan");
}else{
    echo "Gagal menghapus data";
}
?>
