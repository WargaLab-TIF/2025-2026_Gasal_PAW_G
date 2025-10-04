<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Function dengan Parameter</title>
</head>
<body>
  <?php
    // definisi function dengan parameter
    function familyName($fname) {
      echo "$fname<br>";
    }

    // pemanggilan function sebanyak 5 kali
    familyName("Jani");
    familyName("Hege");
    familyName("Stale");
    familyName("Kai Jim");
    familyName("Borge");
  ?>
</body>
</html>
