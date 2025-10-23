<?php
$height =array (
    "Andy" => 176,
    "Ben" => 165,
    "Charlie" => 170
);
echo "Andy is " . $height['Andy']. " cm tall";
echo "<br>";

echo "<br>";
echo "tugas 3.3.1";
echo "<br>";
$height = array_merge($height, array(
    "agus" => 150,
    "rofik" => 190,
    "yani" => 200,
    "yuni" => 160,
    "yuyun" => 160
));

$lastKey = array_key_last($height);
$lastValue = end($height);
echo $lastKey. " => "  . $lastValue. "<br>";
echo "nilai tertinggi dari array = ".count($height)-0;
echo "<br>";

echo "<br>";
echo "tugas 3.3.2 <br>";
unset($height['yuyun']);
$lastKey = array_key_last($height);
$lastValue = end($height);
echo $lastKey. " => "  . $lastValue. "<br>";
echo "nilai tertinggi dari array = ".(count($height)-0);
echo "<br>";

echo "<br>";
echo "tugas 3.3.3 <br>";
$weight = array (
    "heru" => 80,
    "riki" => 75,
    "fiki" => 70
);
$keys = array_keys($weight);
$values = array_values($weight);
echo $keys[1] . " " . $values[1];