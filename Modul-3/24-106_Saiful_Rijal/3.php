<?php
$height = array("Andhi" => 176, "Barry" => 165, "Charlie" => 170);
echo "Andhi is " . $height["Andhi"] . " cm tall.<br>";

// Menambahkan 5 data baru ===== 3.3.1 ======
$height["Dewi"] = 160;
$height["Eka"] = 170;
$height["Fani"] = 175;
$height["Gina"] = 180;
$height["Hani"] = 165;
$indexTerakhirHeight = array_key_last($height);
echo "Index tertinggi dari height: " . $indexTerakhirHeight . " is " . $height[$indexTerakhirHeight] . " cm tall.<br>";

// Menghapus array tertentu height ===== 3.3.2 ======
unset($height["Hani"]);
$indexTerakhirHeight = array_key_last($height);
echo "Index tertinggi dari height: " . $indexTerakhirHeight . " is " . $height[$indexTerakhirHeight] . " cm tall.<br>";

// Membuat array baru weight ===== 3.3.3 ======
$weight = array("Andhi" => 65, "Barry" => 55, "Charlie" => 60);
$index = "Barry";
echo "$index is $weight[$index] kg heavy.<br>";
?>