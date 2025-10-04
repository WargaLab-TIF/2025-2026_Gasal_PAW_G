<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Mencari Posisi String</title>
</head>
<body>
  <?php
    $text = "Hello world!";          // string utama
    $cari = "world";                 // substring yang dicari
    $posisi = strpos($text, $cari);  // built-in function strpos()

 
    echo "$posisi";
  ?>
</body>
</html>
