<?php
include "cekSession.php";
include "navbar.php";
?>
<div class="container">
  <div class="header-row">
    <h2>Dashboard</h2>
  </div>

  <p>Selamat datang, <?=htmlspecialchars($_SESSION['nama'])?>. Gunakan menu di atas.</p>
</div>
