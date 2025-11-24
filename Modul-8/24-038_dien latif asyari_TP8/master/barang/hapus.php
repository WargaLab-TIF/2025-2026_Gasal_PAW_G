<?php
include '../../koneksi.php';

$id = $_GET['id'];

$conn->query("DELETE FROM barang WHERE id=$id");

echo "<script>alert('Barang dihapus'); window.location='index.php';</script>";
?>
