<?php
// Array awal
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Tambah 5 data baru
$height["Sirul"] = "180";
$height["Firman"] = "172";
$height["Zanuar"] = "169";
$height["Rayyan"] = "174";
$height["Raihan"] = "177";

// menampilkan nilai indeks terakhir
$lastValue = end($height);
$lastKey = key($height);
echo "Nilai indeks terakhir dari \$height adalah: " . $lastKey . " => " . $lastValue . "<br><br>";
unset($height["Charlie"]);

// Untuk nilai dengan indeks terakhir setelah fi hapus
$lastValueAfter = end($height);
$lastKeyAfter = key($height);
echo "Setelah menghapus 'Charlie', nilai indeks terakhir sekarang: " . $lastKeyAfter . " => " . $lastValueAfter . "<br><br>";

// Array baru weight
$weight = array("Andy"=>"60", "Barry"=>"55", "Charlie"=>"65");

$values = array_values($weight);
echo "Data ke-2 dari array \$weight adalah: " . $values[1];
?>
