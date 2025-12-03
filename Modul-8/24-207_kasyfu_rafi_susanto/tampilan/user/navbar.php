<nav class="nav d-flex justify-content-between align-items-center rounded-3 shadow-sm mt-2 w-100">
    <div class="d-flex ">
        <a class="nav-link <?= ($page == "home")? 'active': '' ?>" href="home.php">Home</a>
        <a class="nav-link <?= ($page == "transaksi")? 'active': '' ?> " href="transaksi.php">Transaksi</a>
        <a class="nav-link <?= ($page == "laporan")? 'active': '' ?> " href="laporan.php">Laporan</a>
        <a class="nav-link" href="../../controler/log_auth.php">Logout</a>
    </div>
    <div class="d-flex align-items-center">
        <p class="m-0 pe-3 text-primary"><?= $_SESSION["username"] ?? '' ?></p>
    </div>
</nav>