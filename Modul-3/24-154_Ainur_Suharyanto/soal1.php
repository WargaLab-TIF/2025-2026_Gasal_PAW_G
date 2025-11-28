<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "Data awal: ";
print_r($fruits);
echo "<br><br>";

array_push($fruits, "Mango", "Apple", "Orange", "Grapes", "Banana");

echo "Setelah menambah 5 data baru: ";
print_r($fruits);
echo "<br>";

$lastIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$lastIndex] . "<br>";
echo "Indeks tertinggi dari array \$fruits: $lastIndex<br><br>";

unset($fruits[1]);
echo "Setelah menghapus 1 data (Blueberry): ";
print_r($fruits);
echo "<br>";

$keys = array_keys($fruits);
$maxIndex = max($keys);
echo "Nilai dengan indeks tertinggi sekarang: " . $fruits[$maxIndex] . "<br>";
echo "Indeks tertinggi sekarang: $maxIndex<br><br>";

$veggies = array("Carrot", "Spinach", "Broccoli");

echo "Array \$veggies berisi: ";
print_r($veggies);
echo "<br><br>";

echo "Seluruh data dalam \$veggies:<br>";
foreach ($veggies as $veg) {
    echo "$veg, ";
}
?>
