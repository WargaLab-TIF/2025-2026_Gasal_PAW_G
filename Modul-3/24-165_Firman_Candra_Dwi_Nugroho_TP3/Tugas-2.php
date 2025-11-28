<?php

//==========//
//  3.2.1   //
//==========//
echo "3.2.1 <br>";
echo "<br>";


$fruits = array("Avocado", "Blueberry", "Cherry");

$buahBaru = array("Durian", "Mango", "Apple", "Orange", "Pineapple");

for($i = 0; $i < count($buahBaru); $i++) {
    $fruits[] = $buahBaru[$i]; 
}

$arcLength = count($fruits);

echo "Panjang dari data saat ini yaitu : $arcLength <br>";

for($x = 0; $x < $arcLength; $x++) {
    echo $fruits[$x] . "<br>";
}


echo "<br>";
echo "<br>";
echo "<br>";

//==========//
//  3.2.2   //
//==========//
echo "3.2.2 <br>";
echo "<br>";

$veggies = array("Carrot", "Spinach", "Broccoli");

$arcLength = count($veggies);

for($x = 0; $x < $arcLength; $x++) {
    echo $veggies[$x];
    echo "<br>";
}

?>
