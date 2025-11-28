<?php 
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Andy is ". $height['Andy']." cm tall";
echo "<hr>";
// 3.3.1

$height["Jefri"] = "172";
$height["Lewis"] = "165";
$height["Fuzuka"] = "180";
$height["Jordan"] = "169";
$height["Edward"] = "178";
$lastDataKey1 = array_key_last($height);
echo "Nilai indeks terakhir setelah menambah 5 data: ".$height[$lastDataKey1];
echo "<hr>";

// 3.3.2
array_pop($height);
$lastDataKey2 = array_key_last($height);
echo "Nilai indeks terakhir setelah menghapus 1 data: ".$height[$lastDataKey2];
echo "<hr>";

// 3.3.3
$weight = ["Andy" => "67", "Barry" => "72", "Charlie" => "65"];
echo "Data ke-2: Berat badan Barry adalah ". $weight["Barry"] . " kg";
?>