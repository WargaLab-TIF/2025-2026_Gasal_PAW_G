<?php
require_once __DIR__. "/../koneksi.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $query_cek = "SELECT count(*) FROM transaksi_detail WHERE barang_id = '$id'";
    $cek_proses = $conn->query($query_cek);
    $hasil = $cek_proses->fetch_assoc();
    if($hasil["count(*)"] > 0){
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail!');window:location='../../index.php'</script>";
        
    }else{
        $query_delet = "DELETE FROM barang WHERE id = '$id'";
        $conn->query($query_delet);
        header("location:../../index.php");
    }
}
?>

