<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for ($i=0; $i < $arrlength ; $i++) { 
    echo $fruits[$i];
    echo "<br>";
}

echo "<hr>";

//3.2.1
$TambahBuah = array("Orange", "Kiwi", "Banana", "Melon", "Lemon");
foreach ($TambahBuah as $x) {
    $fruits[] = $x;
}    

echo "Tambahan buah sebagai berikut: <br>";

foreach($fruits as $x) {
    echo "$x <br>";
}

echo "<hr>";
//3.2.2
$veggies = array("Tomat", "Wortel", "Bayem");
echo "Menampilkan data sayuran: <br>";
foreach ($veggies as $y) {
    echo "$y <br>";
}

?>
