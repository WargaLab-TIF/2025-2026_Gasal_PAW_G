<?php 
session_start();
include "config.php";
include "menu.php";

// Daftar halaman valid
$pages = [
    'home',
    'data_barang',
    'data_supplier',
    'data_pelanggan',
    'data_user',
    'transaksi',
    'laporan',
    'pelanggan_add',
    'pelanggan_hapus',
    'pelanggan_simpan',
    'supplier_add',
    'supplier'
];

// Ambil halaman dari URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Cek apakah file halaman ada
if (in_array($page, $pages) && file_exists("pages/$page.php")) {
    include "pages/$page.php";
} else {
    echo "<h2>Halaman tidak ditemukan!</h2>";
}
?>
