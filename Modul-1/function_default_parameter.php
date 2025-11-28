<!DOCTYPE html>
<html>
<body>

<?php
function setHeight($minheight = 50) {
  echo "The height is : $minheight <br>";
}

setHeight();       // tanpa argumen → default 50
setHeight(350);    // dengan argumen
setHeight(135);
setHeight(80);
?>

</body>
</html>