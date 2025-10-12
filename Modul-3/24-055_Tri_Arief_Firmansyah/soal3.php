<?php
// 3.3.1 Tambah 5 data baru
$height = ["Alex" => 170, "Bianca" => 165, "Candice" => 160];
$height["Raga"] = 175;
$height["Nanda"] = 158;
$height["Helmi"] = 180;
$height["Riko"] = 162;
$height["Hanip"] = 168;

echo "<h3>3.3.1 Tambah 5 Data</h3>";
print_r($height);
echo "<br>Indeks terakhir: " . array_key_last($height);

// 3.3.2 Hapus 1 data tertentu
unset($height["Candice"]);
echo "<h3>3.3.2 Setelah Hapus Data</h3>";
print_r($height);
echo "<br>Indeks terakhir: " . array_key_last($height);

// 3.3.3 Array weight
$weight = ["Alex" => 65, "Bianca" => 55, "Candice" => 60];
echo "<h3>3.3.3 Array Weight</h3>";
print_r($weight);
echo "<br>Data ke-2: " . array_values($weight)[1];
?>
