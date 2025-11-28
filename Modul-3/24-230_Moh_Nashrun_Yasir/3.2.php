<?php 
$fruits = ["Avocado", "Blueberry", "Cherry"];
$arrlenght = count($fruits);

for($x = 0; $x < $arrlenght; $x++) {
    echo $fruits[$x];
    echo "<br>";
};
echo "<hr>";

// 3.2.1
$fruitsNew =  ["Watermelon", "Pineapple", "Orange", "Mango", "Guava"];

foreach ($fruitsNew as $b) {
    $fruits[] = $b; // menambahkan tiap buah ke array utama
}
// Tampilkan seluruh data buah setelah penambahan
echo "Daftar buah setelah penambahan:<br>";
foreach ($fruits as $b) {
    echo "- $b <br>";
}
echo "<hr>";

// 3.2.2
$veggies = ["Potato", "Lettuce", "Garlic"];
echo "Daftar sayuran:<br>";
foreach ($veggies as $s) {
    echo "- $s <br>";
}
?>