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

// Menampilkan seluruh data dengan Looping for
$keys = array_keys($height);
$values = array_values($height);
echo "Data tinggi badan:<br>";
for ($i = 0; $i < count($height); $i++) {
    echo $keys[$i] ." : " . $values[$i] . "cm<br>";
}

// Membuat array weight baru
$weight = [
    "Nurul" => 60,
    "Anis"  => 65,
    "Septi" => 55,
];

echo "<br>Data berat badan:<br>";
$keys2 = array_keys($weight);
$values2 = array_values($weight);

for ($i = 0; $i < count($weight); $i++) {
    echo $keys2[$i] . " : " . $values2[$i] . "kg<br>";
}
?>