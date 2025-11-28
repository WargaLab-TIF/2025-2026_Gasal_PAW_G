<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Function dengan Default Parameter</title>
</head>
<body>
  <?php
    // definisi function dengan parameter default
    function setHeight($minheight = 50) {
      echo "The height is : $minheight <br>";
    }

    // pemanggilan function tanpa argumen
    setHeight();
  ?>
</body>
</html>
