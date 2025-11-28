<?php
echo "<h2>3.1. Array Terindeks</h2>";

// Deklarasi array awal
$fruits = ["Apple", "Banana", "Cherry"];
echo "Array awal: ";
print_r($fruits);

// 3.1.1. Tambahkan 5 data baru
echo "<h3>3.1.1. Tambah 5 Data Baru</h3>";
$fruits[] = "Durian";
$fruits[] = "Elderberry";
array_push($fruits, "Fig", "Grape", "Honeydew");
echo "Array setelah tambah 5 data: ";
print_r($fruits);

$lastIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$lastIndex] . "<br>";
echo "Indeks tertinggi: " . $lastIndex . "<br>";

// 3.1.2. Hapus 1 data tertentu
echo "<h3>3.1.2. Hapus 1 Data</h3>";
unset($fruits[2]); // Hapus data dengan indeks 2 (Cherry)
echo "Array setelah hapus indeks 2: ";
print_r($fruits);

$lastIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$lastIndex] . "<br>";
echo "Indeks tertinggi: " . $lastIndex . "<br>";

// 3.1.3. Buat array baru veggies
echo "<h3>3.1.3. Array Veggies</h3>";
$veggies = ["Carrot", "Broccoli", "Spinach"];
echo "Array veggies: ";
print_r($veggies);
?>