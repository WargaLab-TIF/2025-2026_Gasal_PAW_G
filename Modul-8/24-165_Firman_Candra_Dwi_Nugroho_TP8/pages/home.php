<h1>Selamat datang, <?= $_SESSION['username'] ?> 👋</h1>
<p>Anda login sebagai level <?= $_SESSION['level'] == 1 ? 'Owner' : 'Kasir' ?></p>
