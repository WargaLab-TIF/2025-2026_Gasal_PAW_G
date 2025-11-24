<?php
include "../../koneksi.php";

$id = $_GET['id_user'];
mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");
header("Location: ../../data_user.php");
?>