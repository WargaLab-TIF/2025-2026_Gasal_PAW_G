<?php
// 3.3.1
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andi is " . $height["Andy"] . " cm tall";
echo "<br> <br>";

$height["Aziz"] = "168";
$height["Ucup"] = "145";
$height["Adi"] = "180";
$height["Wawan"] = "178";
$height["Firman"] = "175";

echo "Nilai index terakhir = " . end($height) . " dan index terakhit = " . array_key_last($height);
echo "<br> <br>";

// 3.3.2
unset($height["Firman"]);
echo "Nilai index terakhir = " . end($height) . " dan index terakhit = " . array_key_last($height);
echo "<br> <br>";

// 3.3.3
$weight = array("Andy"=>"76", "Barry"=>"65", "Charlie"=>"70");
$isi = array_values($weight);
echo "Data ke 2 dari array weight = " . $isi[1];
?>