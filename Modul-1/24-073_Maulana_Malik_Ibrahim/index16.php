<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Function Penjumlahan</title>
</head>
<body>
  <?php
    // definisi function dengan 2 parameter
    function sum($x, $y) {
      $z = $x + $y; // hasil penjumlahan
      echo " $x + $y = $z<br>";
    }

    // pemanggilan function
    sum(5, 10);
    sum(7, 13);
    sum(2, 4);
  ?>
</body>
</html>
