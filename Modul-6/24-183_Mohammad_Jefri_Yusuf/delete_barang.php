<?php 
require "conn.php";
require "functions.php";

if(isset($_GET["id"])){
    if (deleteBarang($conn, $_GET["id"]) > 0) {
        echo "
            <script> 
            alert('Data berhasil dihapus');
            document.location.href = 'index.php'
            </script>
        ";
        } else {
        echo "
            <script> 
            alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');
            document.location.href = 'index.php'
            </script>
        ";
        };
    
}
?>