<?php
// arrau terimdeks
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "Data awal: ";
print_r($fruits);
echo "<br><br>";

// menambah 5 data baru
array_push($fruits, "Durian", "Apple", "Mango", "Orange", "Grape");
echo "Setelah menambah 5 data: ";
print_r($fruits);
echo "<br>";

// nilai dengan indeks tertinggi
$lastIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$lastIndex] . "<br>";
echo "Indeks tertinggi sekarang: " . $lastIndex . "<br><br>";

unset($fruits[2]); 

// agat menampilkan semua data setelah dihapus
echo "Setelah menghapus 1 data: ";
print_r($fruits);
echo "<br>";

// cari indeks tertinggi setelah pejhabusan
$keys = array_keys($fruits);
$lastIndex = max($keys);
echo "Nilai dengan indeks tertinggi sekarang: " . $fruits[$lastIndex] . "<br>";
echo "Indeks tertinggi setelah penghapusan: " . $lastIndex . "<br><br>";

// array baru 
$veggies = array("Carrot", "Broccoli", "Spinach");

// menampilkan semua cod
echo "Data array \$veggies: ";
print_r($veggies);
?>
