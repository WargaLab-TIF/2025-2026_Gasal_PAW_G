<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . "." . "<br><br>";

// 3.1.1 Tambahkan 5 data baru
array_push($fruits, "Grapes", "Watermelon", "Pineapple", "Strawberry", "Kiwi");

// Nilai dengan indeks tertinggi
$maxIndex = count($fruits) - 1;
echo "Nilai indeks tertinggi: " . $fruits[$maxIndex] . "<br><br>";
echo "Indeks tertinggi: $maxIndex <br><br>";

// 3.1.2 Hapus 1 data tertentu
unset($fruits[2]);
$fruits = array_values($fruits);

// Nilai dengan indeks tertinggi
$maxIndex = count($fruits) - 1;
echo "Nilai indeks tertinggi setelah hapus: " . $fruits[$maxIndex] . "<br><br>";
echo "Indeks tertinggi sekarang: $maxIndex <br><br>";

// 3.1.3 Array baru $veggies
$veggies = array("Carrot", "Broccoli", "Spinach");
echo "Data dalam array veggies:<br>";
foreach ($veggies as $v) {
    echo "$v<br>";
}
?>