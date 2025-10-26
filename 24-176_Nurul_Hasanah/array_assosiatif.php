<?php
$height = [
    "Nurul" => 165,
    "Anis"  => 170,
    "Septi" => 160,
];

// Menambahkan 5 data baru
$height["Fajar"] = 175;
$height["Latif"] = 168;
$height["Darma"] = 172;
$height["Sukandi"] = 158;
$height["Hilman"] = 162;

echo "Data tinggi badan:<br>";
print_r($height);
echo "<br><br>";

// Menghapus 1 data
unset($height["Septi"]);
echo "Setelah hapus 1 data:<br>";
print_r($height);
echo "<br><br>";

// Array weight
$weight = ["Nurul" => 60, "Anis" => 65, "Fajar" => 70];
echo "Data berat ke-2: " . array_values($weight)[1];
?>