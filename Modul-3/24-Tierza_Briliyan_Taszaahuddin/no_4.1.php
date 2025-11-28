<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

echo "Data Height Awal:<br><br>";
foreach ($height as $x => $value) {
    echo "Key = " . $x . ", Value = " . $value . "<br>";
}

$height["Septi"] = "160";
$height["Riko"] = "175";
$height["El"] = "168";
$height["Biyan"] = "180";
$height["Arfian"] = "162";

echo "<br>Data Height Setelah Penambahan:<br><br>";
foreach ($height as $x => $value) {
    echo "Key = " . $x . ", Value = " . $value . "<br>";
}

$weight = array(
    "Andy" => "65",
    "Barry" => "58",
    "Charlie" => "63"
);

echo "<br>Data Height (Akhir):<br><br>";
foreach ($height as $x => $value) {
    echo "Key = " . $x . ", Value = " . $value . "<br>";
}

echo "<br>Data Weight:<br><br>";
foreach ($weight as $x => $value) {
    echo "Key = " . $x . ", Value = " . $value . "<br>";
}
?>
