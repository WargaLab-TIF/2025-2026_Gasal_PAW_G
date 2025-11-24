<?php
include "koneksi.php";
include "cekSession.php";

$id = $_GET['id'] ?? '';
if ($id) {
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id='$id'");
}

header("Location: pelanggan.php");
exit;
?>