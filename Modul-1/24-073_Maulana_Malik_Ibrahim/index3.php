<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Case Sensitive Variabel PHP</title>
</head>
<body>
  <?php
    $color = "silver";   // variabel pertama
    $COLOR = "white";    // variabel kedua

    echo "<p>My car is $color</p>";
    echo "<p>My house is $COLOR</p>";
  ?>
</body>
</html>
