<?php
$height = array(
    "Andy" => "176",
    "Berry" => "165",
    "Charlie" => "170",
    "Jordan" => "173",
    "Asep" => "167",
    "Rahmat" => "180",
    "Azka" => "178",
    "Putri" => "160",
);

echo "Andy is ".$height["Andy"]." cm tall";
echo "<br>";

echo $height["Putri"];
echo "<br>";

array_pop($height);
echo $height["Azka"];


echo "<hr>";

$weight = array(
    "Udin" => "60",
    "Asep" => "67",
    "Agus" => "80",
);

echo $weight["Asep"];
?>