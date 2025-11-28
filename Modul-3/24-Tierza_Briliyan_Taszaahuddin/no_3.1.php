<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

echo "Andy is " . $height['Andy'] . " cm tall.<br><br>";

$height["Diana"] = "160";
$height["Edward"] = "175";
$height["Fiona"] = "168";
$height["George"] = "180";
$height["Helen"] = "162";

echo "Daftar tinggi setelah ditambah:<br>";
foreach ($height as $name => $value) {
    echo "$name : $value cm<br>";
}

$lastValue = end($height);
$key1 = key($height);

$indexTerakhir = count($height);

echo "<br>Nilai dengan indeks terakhir adalah (indeks ke-$indexTerakhir): $key1 = $lastValue cm<br><br>";

unset($height["Barry"]);

echo "Setelah menghapus data 'Barry':<br>";
foreach ($height as $name => $value) {
    echo "$name : $value cm<br>";
}

$lastValue = end($height);
$key1 = key($height);
$indexTerakhir = count($height);

echo "<br>Nilai terakhir sekarang (indeks ke-$indexTerakhir): $key1 = $lastValue cm<br><br>";

$weight = array("Andy" => "65", "Barry" => "58", "Charlie" => "60");

echo "<b>Data berat badan:</b><br>";
foreach ($weight as $name => $value) {
    echo "$name : $value kg<br>";
}

$keys = array_keys($weight);
$secondKey = $keys[1];
echo "<br>Data ke-2 berat badan adalah: $secondKey = " . $weight[$secondKey] . " kg";
?>
