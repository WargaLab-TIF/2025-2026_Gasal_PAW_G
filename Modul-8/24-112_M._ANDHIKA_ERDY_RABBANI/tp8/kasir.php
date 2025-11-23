<?php
require_once "session.php";
deny_if_not_logged_in();
require_level(2);
require_once "conn.php";
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard Kasir</title></head>
<body>
<?php include "navbar.php"; ?>
<h2>Dashboard Kasir (Level 2)</h2>

<p>Menu Transaksi & Laporan</p>
<ul>
    <li><a href="transaksi.php">Buat Transaksi</a></li>
    <li><a href="laporan.php">Lihat Laporan</a></li>
</ul>

</body>
</html>
