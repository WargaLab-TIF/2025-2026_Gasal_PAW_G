<?php
include "koneksi.php";
include "cekSession.php";

$id = intval($_GET['id'] ?? 0);
if($id){
    mysqli_query($conn, "DELETE FROM supplier WHERE id=$id");
}
header("Location: supplier.php");
exit;
?>
