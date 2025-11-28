<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menghitung Jumlah Kata</title>
</head>
<body>
  <?php
    $text = "Hello world!";            // string yang akan dihitung
    $jumlahKata = str_word_count($text); // built-in function str_word_count()

    echo "$jumlahKata";
  ?>
</body>
</html>
