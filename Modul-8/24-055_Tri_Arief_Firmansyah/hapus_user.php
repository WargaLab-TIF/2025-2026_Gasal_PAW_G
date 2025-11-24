<?php
include "koneksi.php";
include "cek_session.php";
if($_SESSION['level'] != 1){ header("Location: user.php"); exit; }
$id = intval($_GET['id'] ?? 0);
if($id){
    mysqli_query($conn, "DELETE FROM user WHERE id_user=$id");
}
header("Location: user.php"); exit;
?>
