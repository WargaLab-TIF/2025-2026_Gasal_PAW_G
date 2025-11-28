<?php
// 3.6.1 array_push()
echo "array_push()<br>";
$buah = ["Apel", "Jeruk", "Mangga"];
echo "Sebelum ditambah: ";
echo implode(", ", $buah);
array_push($buah, "Pisang", "Melon");
echo "<br>Setelah ditambah (array_push): ";
echo implode(", ", $buah);
echo "<hr>";

// 3.6.2 array_merge()
echo "array_merge()<br>";
$buah1 = ["Apel", "Jeruk"];
$buah2 = ["Mangga", "Pisang"];
echo "Array 1: " . implode(", ", $buah1);
echo "<br>Array 2: " . implode(", ", $buah2);
$hasilGabung = array_merge($buah1, $buah2);
echo "<br>Output: " . implode(", ", $hasilGabung);
echo "<hr>";

// 3.6.3 array_values()
echo "array_values()<br>";
$buahAsosiatif = ["a" => "Apel", "b" => "Jeruk", "c" => "Mangga"];
echo "Array asosiatif: ";
print_r($buahAsosiatif);
$hasil = array_values($buahAsosiatif);
echo "<br>Setelah array_values(): ";
print_r($hasil);
echo "<hr>";

// 3.6.4 array_search()
echo "array_search()<br>";
$buahCari = ["Apel", "Jeruk", "Mangga", "Pisang"];
$cari = "Mangga";
$index = array_search($cari, $buahCari);
echo "array: " . implode(", ", $buahCari);
echo "<br>Posisi '$cari' ada di index ke-$index";
echo "<hr>";

// 3.6.5 array_filter()
echo "array_filter()<br>";
$angka = [1,2,3,4,5,6,7,8,9,10];
echo "Semua angka: " . implode(", ", $angka);
$genap = array_filter($angka, function($n){ return $n % 2 == 0; });
echo "<br>Angka genap: " . implode(", ", $genap);
echo "<hr>";

// 3.6.6 Fungsi Sorting
echo "Fungsi Sorting<br>";
$buahSort = ["Mangga", "Apel", "Pisang", "Jeruk"];
echo "Array awal: " . implode(", ", $buahSort);

sort($buahSort);
echo "<br>sort() -> " . implode(", ", $buahSort);

rsort($buahSort);
echo "<br>rsort() -> " . implode(", ", $buahSort);

$nilai = ["Andi" => 80, "Budi" => 70, "Citra" => 90];
echo "<br><br>Data nilai awal: ";
foreach($nilai as $n => $v){ echo "$n=$v "; }

asort($nilai);
echo "<br>asort() -> ";
foreach($nilai as $n => $v){ echo "$n=$v "; }

arsort($nilai);
echo "<br>arsort() -> ";
foreach($nilai as $n => $v){ echo "$n=$v "; }

ksort($nilai);
echo "<br>ksort() -> ";
foreach($nilai as $n => $v){ echo "$n=$v "; }

krsort($nilai);
echo "<br>krsort() -> ";
foreach($nilai as $n => $v){ echo "$n=$v "; }
?>