<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function nav_link($href, $label) {
    echo '<li class="nav-item"><a class="nav-link" href="'.htmlspecialchars($href).'">'.htmlspecialchars($label).'</a></li>';
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Sistem Penjualan</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto"> 
<?php
// If not logged in, show only Login
if (!isset($_SESSION['level'])) {
    nav_link('login.php', 'Login');
} else {
    // common for all logged users
    nav_link('index.php', 'Home');
    // Level 1 (owner/admin) sees Data Master
    if ($_SESSION['level'] == 1) {
        echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="masterMenu" role="button" data-toggle="dropdown">Data Master</a>
            <div class="dropdown-menu">';
        echo '<a class="dropdown-item" href="crud_user.php">Data User</a>';
        // placeholders for other master pages
        echo '<a class="dropdown-item" href="#">Data Barang</a>';
        echo '<a class="dropdown-item" href="#">Data Supplier</a>';
        echo '<a class="dropdown-item" href="#">Data Pelanggan</a>';
        echo '</div></li>';
        nav_link('transaksi.php', 'Transaksi');
        nav_link('laporan.php', 'Laporan');
    } else {
        // level 2 (kasir) has limited nav
        nav_link('transaksi.php', 'Transaksi');
        nav_link('laporan.php', 'Laporan');
    }
}
?>
    </ul>
    <ul class="navbar-nav">
<?php if (isset($_SESSION['level'])): ?>
    <li class="nav-item"><span class="nav-link">Hai, <?=htmlspecialchars($_SESSION['nama'] ?? 'User')?></span></li>
    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
<?php endif; ?>
    </ul>
  </div>
</nav>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
