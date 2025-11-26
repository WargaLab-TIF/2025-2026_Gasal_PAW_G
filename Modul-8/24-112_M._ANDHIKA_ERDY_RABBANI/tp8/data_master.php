<?php
require_once "session.php";
deny_if_not_logged_in();
require_level(1); // hanya owner
include "navbar.php";
?>
<h2>Data Master</h2>
<ul>
    <li><a href="/TP/tp8/crud_barang/data_barang.php">Data Barang</a></li>
    <li><a href="/TP/tp8/crud_supplier/data_supplier.php">Data Supplier</a></li>
    <li><a href="/TP/tp8/crud_pelanggan/data_pelanggan.php">Data Pelanggan</a></li>
    <li><a href="/TP/tp8/crud_user/data_user.php">Data User</a></li>
</ul>
