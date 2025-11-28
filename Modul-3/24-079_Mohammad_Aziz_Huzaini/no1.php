<?php
// 3.1.1
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Guava", "Banana", "Orange", "Manggo", "Apple");
echo "I like " . $fruits[0] . ", " . $fruits[1] . ", " . $fruits[2] . ", " . $fruits[3] . ", " . $fruits[4] . ", " . $fruits[5] . ", " . $fruits[6] . " and " . $fruits[7] . ".";
echo "<br>";
echo end($fruits);
echo "<br>";
echo "Index teretinggi = " . array_key_last($fruits);

echo "<br> <br>";
// 3.1.2
unset($fruits[7]);
echo end($fruits);
echo "<br>";
echo "Index tertinggi = " . array_key_last($fruits);

echo "<br> <br>";
// 3.1.3
$vaggies = array("bayam", "wortel", "Sawi");
var_dump($vaggies);
?>