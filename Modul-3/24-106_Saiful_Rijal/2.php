<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "Panjang array: $arrlength <br>";
echo "<hr>";

// menambahkan 5 data baru ===== 3.2.1 ======

$dataBaru = array("Durian", "Eggplant", "Fig", "Grape", "Honeydew");
for ($i = 0; $i < count($dataBaru); $i++) {
    array_push($fruits, $dataBaru[$i]);
}
$arrlength = count($fruits);

for ($x = 0; $x < count($fruits); $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "Panjang array: $arrlength <br>";
echo "<hr>";

// buat array baru ====== 3.2.2 ======
$veggies = array("Asparagus", "Broccoli", "Cabbage");
$arrveggieslength = count($veggies);

for ($x = 0; $x < $arrveggieslength; $x++) {
    echo $veggies[$x];
    echo "<br>";
};
?>
