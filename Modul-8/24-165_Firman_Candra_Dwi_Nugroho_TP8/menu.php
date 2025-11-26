<?php if (!isset($_SESSION['username'])) header("Location: login.php"); ?>

<nav>
<a href="index.php?page=home">Home</a>

<?php if ($_SESSION['level'] == 1): ?>
    | <a href="index.php?page=data_barang">Data Barang</a>
    | <a href="index.php?page=data_supplier">Data Supplier</a>
    | <a href="index.php?page=data_pelanggan">Data Pelanggan</a>
    | <a href="index.php?page=data_user">Data User</a>
<?php endif; ?>

| <a href="index.php?page=transaksi">Transaksi</a>
| <a href="index.php?page=laporan">Laporan</a>

| <?= $_SESSION['username'] ?> <a href="logout.php">(Logout)</a>
</nav>
<hr>
