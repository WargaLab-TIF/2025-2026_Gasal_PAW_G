<?php 

//==========//
//  3.1.1   //
//==========//
echo "3.1.1 <br>";
echo "<br>";

$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Kiwi", "Manggo", "Apple", "Orange", "Pineapple");
$tertinggi = count($fruits) - 1;

echo "Nilai indeks tertinggi adalah: " . $fruits[$tertinggi] . "<br>";
echo "Indeks tertinggi adalah: " . $tertinggi . "<br>";

print_r($fruits);

echo "<br>";
echo "<br>";
echo "<br>";

//===========//
//   3.1.2   //
//===========//
echo "3.1.2 <br>";
echo "<br>";

array_pop($fruits);
$tertinggi = count($fruits) - 1;

echo "Nilai indeks tertinggi adalah: " . $fruits[$tertinggi] . "<br>";
echo "Indeks tertinggi adalah: " . $tertinggi . "<br>";

print_r($fruits);

echo "<br>";
echo "<br>";
echo "<br>";

//==========//
//  3.1.3   //
//==========//
echo "3.1.3 <br>";
echo "<br>";

$veggies = array("Carrot", "Broccoli", "Tomato");

echo "Data array veggies: <br>";
foreach ($veggies as $y) {
    echo $y . ",";
}


?>