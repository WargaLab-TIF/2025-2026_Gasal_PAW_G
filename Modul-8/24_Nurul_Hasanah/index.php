<?php
include "proteksi.php";
?>

<h2>Selamat Datang, <?php echo $_SESSION["nama"]; ?></h2>

<?php

if($_SESSION["level"] == 1){
?>
   <ul>
      <li><a href="home.php">Home</a></li>

      <li>Data Master
        <ul>
            <li><a href="barang.php">Data Barang</a></li>
            <li><a href="supplier.php">Data Supplier</a></li>
            <li><a href="pelanggan.php">Data Pelanggan</a></li>
            <li><a href="user.php">Data User</a></li>
</ul>

<?php

} else {
?>

  <ul>
    <li><a href="home.php">Home</a></li>
    <li><a href="transaksi.php">Transaksi</a></li>
    <li><a href="laporan.php">Laporan</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<?php } ?>