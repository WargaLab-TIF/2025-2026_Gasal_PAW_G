<?php
$conn = mysqli_connect("localhost","root","","penjualan");
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM pelanggan WHERE id = '$id'";
    if(mysqli_query($conn,$query)){
        header("location:../../pelanggan.php");
    }else{
        echo "data gagal dihapus";
    }
}

?>