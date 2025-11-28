<?php
echo "<h2>3.2. Array dengan Looping</h2>";

$fruits = ["Apple", "Banana", "Cherry"];
echo "Array awal: ";
print_r($fruits);

// 3.2.1. Tambah 5 data dengan perulangan FOR
echo "<h3>3.2.1. Tambah 5 Data dengan FOR</h3>";
$newFruits = ["Durian", "Elderberry", "Fig", "Grape", "Honeydew"];
for ($i = 0; $i < count($newFruits); $i++) {
    $fruits[] = $newFruits[$i];
}

echo "Panjang array fruits: " . count($fruits) . "<br>";
echo "Tampilkan semua data dengan FOR:<br>";

// Perlu perubahan karena jumlah data bertambah
for ($i = 0; $i < count($fruits); $i++) {
    echo "Index $i: " . $fruits[$i] . "<br>";
}

// 3.2.2. Array veggies dengan looping
echo "<h3>3.2.2. Array Veggies dengan Looping</h3>";
$veggies = ["Carrot", "Broccoli", "Spinach"];
echo "Array veggies dengan FOR:<br>";
for ($i = 0; $i < count($veggies); $i++) {
    echo "Index $i: " . $veggies[$i] . "<br>";
}
?>