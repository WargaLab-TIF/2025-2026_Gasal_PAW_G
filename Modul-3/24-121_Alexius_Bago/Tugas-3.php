<?php
$height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
echo "Andy is " . $height['Andy'] . " cm tall." . "<br><br>";

// 3.3.1 Tambahkan 5 data baru
$height["Deni"] = 175;
$height["Eka"] = 172;
$height["Fina"] = 168;
$height["Gilang"] = 178;
$height["Hani"] = 163;

// Nilai dengan indeks tertinggi
$keys = array_keys($height);
$last_key = $keys[count($keys) - 1];
echo "Nilai dengan indeks terakhir: " . $height[$last_key] . "<br><br>";

// 3.3.2 Hapus 1 data tertentu
unset($height["Cici"]);

// Nilai dengan indeks tertinggi
$keys = array_keys($height);
$last_key = $keys[count($keys) - 1];
echo "Nilai terakhir setelah hapus: " . $height[$last_key] . "<br><br>";

// 3.3.3 Array baru $weight
$weight = array("Andi" => 60, "Budi" => 55, "Cici" => 48);
$values = array_values($weight);
echo "Data ke-2 dari weight: " . $values[1] . "<br>";
?>