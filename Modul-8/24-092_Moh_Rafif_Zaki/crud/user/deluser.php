<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM `user` WHERE id_user = '$id'";
    if(mysqli_query($conn,$query)){
        header("location:../../user.php");
    }else{
        echo "Data gagal dihapus";
    }
}

?>