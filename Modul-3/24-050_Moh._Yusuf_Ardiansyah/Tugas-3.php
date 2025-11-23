<?php
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
echo "Andy is " .$height['Andy'] . " cm tall.";
echo "<br>";

// 3.3.1
$height['Kairi'] = 172;
$height['Sanz'] = 175;
$height['Lutpi'] = 170;
$height['Kiboy'] = 169;
$height['Skylar'] = 180;

$nilai_terakhir = end($height);
echo "Nilai dengan indeks terakhir adalah: " . $nilai_terakhir;
echo "<br>";

// 3.3.2
unset($height['Skylar']);

$nilai_terakhir = end($height);

echo "Setelah 'Skylar' dihapus, nilai dengan indeks terakhir adalah: " . $nilai_terakhir;
echo "<br>";

// 3.3.3
$weight = array("Kairi" => 70, "Skylar" => 60, "Kiboy" => 56);
$keys = array_keys($weight);
$keys_kedua = $keys[1];
$value_kedua = $weight[$keys_kedua];
echo "data ke-2 dalam array adalah: " . $keys_kedua . " => " . $value_kedua;
?>
