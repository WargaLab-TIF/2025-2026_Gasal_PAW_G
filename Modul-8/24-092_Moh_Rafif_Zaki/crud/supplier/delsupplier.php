<?php
$conn = mysqli_connect("localhost","root","","penjualan");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM supplier WHERE id = '$id'";
    if(mysqli_query($conn,$query)){
        header("location:../../supplier.php");
    }else{
        echo "Menghapus data gagal";
    }
}

?>