<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Function dengan 2 Parameter</title>
</head>
<body>
  <?php
    // definisi function dengan 2 parameter
    function familyName($fname, $year) {
      echo "$fname born in $year<br>";
    }

    // pemanggilan function 3 kali
    familyName("Harge", "1990");
    familyName("Stale", "1995");
    familyName("Kai jim", "2000");
  ?>
</body>
</html>
