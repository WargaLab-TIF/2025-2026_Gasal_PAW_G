<?php
    $fruits = array("avocado","blueberry","cherry");
    $arrlength = count($fruits);
    $fruits_baru = array("manggo","banana","alpukat","kiwi","nanas");
    for ($y=0;$y <5;$y++){
        $fruits[] = $fruits_baru[$y];
    }
    $arrlength = count($fruits);
    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }
    echo "jumlah data pada array : " . $arrlength . "<br>";
    $veggies = array("apel","jeruk","melon");
    $arrlength2 = count($veggies);
    for($a = 0; $a < $arrlength2; $a++) {
        echo $veggies[$a];
        echo "<br>";
    }
?>