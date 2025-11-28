<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrLength = count($fruits);
echo "Input awal array \$fruits:<br>";
for ($x = 0; $x < $arrLength; $x++) {
    echo $fruits[$x] . "<br>";
}
echo "<br>";

// 3.2.1
$tambahanFruits = array("Mango", "Banana", "Guava", "Apple", "Grape");
for ($i = 0; $i < count($tambahanFruits); $i++) {
    array_push($fruits, $tambahanFruits[$i]);
}
$arrLength = count($fruits);
echo "Data array \$fruits ditambah 5 elemen baru:<br>";
for ($x = 0; $x < $arrLength; $x++) {
    echo $fruits[$x] . "<br>";
}
echo "total elemen dalam array \$fruits adalah: $arrLength<br><br>";

// 3.2.2 menggunakan FOR
$veggies = array("stawberry", "cherry", "apple");
$veggiesLength = count($veggies);
echo "daftar buah<br>\$veggies:<br>";
for ($i = 0; $i < $veggiesLength; $i++) {
    echo $veggies[$i] ."";
}
?>
