<?php
// 3.1.1
$fruits = ["Apple", "Banana", "Orange"];
array_push($fruits, "Rambutan", "Nangka", "Melon", "Nanas", "Pepaya");

echo "<h3>3.1.1 Tambah 5 Data</h3>";
print_r($fruits);
echo "<br>Indeks tertinggi: " . (count($fruits) - 1);

// 3.1.2
unset($fruits[2]); // hapus "Orange"
echo "<h3>3.1.2 Setelah Hapus Data</h3>";
print_r($fruits);
echo "<br>Indeks tertinggi: " . (array_key_last($fruits));

// 3.1.3
$veggies = ["Kangkung", "Sawi", "Brocoli"];
echo "<h3>3.1.3 Array Veggies</h3>";
print_r($veggies);
?>
