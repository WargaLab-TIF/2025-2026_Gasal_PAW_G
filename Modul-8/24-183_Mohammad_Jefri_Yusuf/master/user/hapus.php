<?php
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';
require_once 'functions.php';
cekLogin();
cekOwner();

$id = htmlspecialchars($_GET["id"]);

// Fungsi deleteSupplier mengembalikan -1 jika data sedang dipakai di tabel Barang
$hasil = deleteUser($conn, $id);

if ($hasil > 0) {
    echo "<script>alert('Data berhasil dihapus'); location.href='index.php';</script>";
}  else {
    echo "<script>alert('Gagal menghapus data'); location.href='index.php';</script>";
}
?>