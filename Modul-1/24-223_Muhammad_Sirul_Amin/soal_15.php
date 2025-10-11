<?php
// Catatan fungsi harusnya familyName tapi karena
// php tidak bisa mempunyai 2 fungsi dengan nama yang sama jadi jadi saya ubah mas
function fiamilyName($fname, $year) {
  echo "$fname Refsnes. Born in $year <br>";
}

fiamilyName("Hege", "1975");
fiamilyName("Stale", "1978");
fiamilyName("Kai Jim", "1983");
?>
<br>