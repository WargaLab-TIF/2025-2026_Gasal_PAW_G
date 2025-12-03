<?php
include "koneksi.php";
$id = $_GET['id'];

$conn->query("DELETE FROM user WHERE id=$id");

header("Location: user.php");
exit;
?>
