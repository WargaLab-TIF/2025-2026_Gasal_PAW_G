<?php
$height = ["Alex" => 170, "Bianca" => 165, "Candice" => 160];
$height["Raga"] = 175;
$height["Nanda"] = 158;
$height["Helmi"] = 180;
$height["Riko"] = 162;
$height["Hanip"] = 168;

echo "<h3>3.4.1 Looping Height</h3>";
foreach ($height as $name => $h) {
    echo "$name : $h cm<br>";
}
// FOREACH otomatis menyesuaikan jumlah elemen

$weight = ["Alex" => 65, "Bianca" => 55, "Candice" => 60];
echo "<h3>3.4.2 Looping Weight</h3>";
foreach ($weight as $name => $w) {
    echo "$name : $w kg<br>";
}
?>
