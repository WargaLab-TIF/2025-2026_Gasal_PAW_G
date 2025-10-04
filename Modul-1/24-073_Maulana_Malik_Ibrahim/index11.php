<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Mengganti Kata dalam String</title>
</head>
<body>
  <?php
    $text = "Hello world!";                          // string asli
    $textBaru = str_replace("world", "Dolly", $text); // ganti "world" → "Dolly"

    echo "$textBaru";
  ?>
</body>
</html>
