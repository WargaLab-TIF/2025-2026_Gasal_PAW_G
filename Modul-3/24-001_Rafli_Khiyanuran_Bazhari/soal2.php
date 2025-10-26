<?php
// Skrip dasar untuk panjang array dan akses menggunakan FOR loop
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "<br>";

// Pertanyaan 3.2.1
// Menambahkan 5 data baru menggunakan perulangan FOR
// Menghitung panjang array setelah penambahan
// Menampilkan seluruh data dengan perulangan FOR yang dimodifikasi
$new_fruits = array("Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo "<strong>Menambahkan 5 data baru menggunakan perulangan FOR:</strong><br>";
for($i = 0; $i < count($new_fruits); $i++) {
    $fruits[] = $new_fruits[$i];
    echo "Ditambahkan: " . $new_fruits[$i] . "<br>";
}
echo "<br>";

$new_arrlength = count($fruits);
echo "<strong>Panjang array \$fruits saat ini:</strong> " . $new_arrlength . " elemen<br><br>";

echo "<strong>Menampilkan seluruh data array \$fruits dengan perulangan FOR:</strong><br>";
for($x = 0; $x < $new_arrlength; $x++) {
    echo "Indeks " . $x . ": " . $fruits[$x] . "<br>";
}
echo "<br>";

// Pertanyaan 3.2.2
// Membuat array baru $veggies
$veggies = array("Broccoli", "Carrot", "Spinach");
$veggies_length = count($veggies);

echo "<strong>Array baru \$veggies:</strong><br>";
for($x = 0; $x < $veggies_length; $x++) {
    echo "Indeks " . $x . ": " . $veggies[$x] . "<br>";
}
echo "<br>";
?>