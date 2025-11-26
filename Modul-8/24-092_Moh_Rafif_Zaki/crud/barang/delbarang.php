<?php
$conn = mysqli_connect("localhost","root","","penjualan");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM transaksi_detail WHERE barang_id = $id";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)){
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail'); window.location='../../barang.php'</script>";
    }else{
        $query = "DELETE FROM barang WHERE id = $id";
        if(mysqli_query($conn,$query)){
            header("location:../../barang.php");
        }

    }
}
?>