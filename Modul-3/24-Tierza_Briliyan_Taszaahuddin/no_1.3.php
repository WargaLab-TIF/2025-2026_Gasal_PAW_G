<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . "." ; 

array_push($fruits,"jeruk");
array_push($fruits,"apel");
array_push($fruits,"semangka");
array_push($fruits,"anggur merah");
array_push($fruits,"mangga");

$indeks = count($fruits) - 1;
    echo "<br>".$fruits[$indeks]." indeks ke $indeks merupakan indeks terakhir";

array_splice($fruits,1,1);


$indeks1 = count($fruits) - 1;
    echo "<br>indeks tertinggi sekarang setelah update $indeks1";

$veggies = array("tomat","cabe","kol");
    echo "<br>". $veggies[0].", ".$veggies[1].", ".$veggies[2];

?>
