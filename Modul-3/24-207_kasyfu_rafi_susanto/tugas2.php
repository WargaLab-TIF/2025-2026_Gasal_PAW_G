<?php

$fruits =array("avocado","bluberry","Cherry");
array_push($fruits,"grape", "orange", "lemon","appel","strawbery");
$arrlenght = count($fruits);
echo "tugas 3.2.1 <br>";
for ($x = 0; $x < $arrlenght; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "panjang array saat ini " . count($fruits);
echo "<br>";
echo "<br>";
echo "tugas 3.2.2 <br>";
$veggies = array("satu","dua","tigas");
$panjang = count($veggies);
for ($y = 0; $y < $panjang; $y++) {
    echo $veggies[$y];
    echo "<br>";
}

