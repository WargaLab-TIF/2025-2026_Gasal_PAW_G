<?php
// 3.6.1
$buah = ["apel", "mangga", "pisang"];
echo "Sebelum push: ";
var_dump($buah);
echo "<br>";
array_push($buah, "jeruk", "melon");
echo "Sesudah push: ";
var_dump($buah);
echo "<br><br>";

// 3.6.2
$buah1 = ["apel", "pisang"];
$buah2 = ["mangga", "jeruk"];
echo "Array 1: ";
var_dump($buah1);
echo "<br>Array 2: ";
var_dump($buah2);
echo "<br>Hasil gabungan: ";
var_dump(array_merge($buah1, $buah2));
echo "<br><br>";

// 3.6.3
$buahAsli = ["a" => "apel", "b" => "mangga", "c" => "pisang"];
echo "Array asli (ada key huruf): ";
var_dump($buahAsli);
echo "<br>Hasil array_values (hanya nilai, index angka): ";
var_dump(array_values($buahAsli));
echo "<br><br>";

// 3.6.4
$buahCari = ["apel", "pisang", "mangga", "jeruk"];
echo "Array buah: ";
var_dump($buahCari);
echo "<br>Posisi 'mangga' ada di index: " . array_search("mangga", $buahCari);
echo "<br><br>";

// 3.6.5
$angka = [1, 2, 3, 4, 5, 6];
echo "Array angka awal: ";
var_dump($angka);
echo "<br>Hasil filter (angka genap saja): ";
var_dump(array_filter($angka, fn($n) => $n % 2 == 0));
echo "<br><br>";

// 3.6.6
$angka2 = [5, 1, 4, 2, 3];
echo "Array awal: ";
var_dump($angka2);
sort($angka2);
echo "<br>sort() -> urut naik: ";
var_dump($angka2);
$angka2 = [5, 1, 4, 2, 3];
rsort($angka2);
echo "<br>rsort() -> urut turun: ";
var_dump($angka2);
$buahAsli = ["b" => "mangga", "a" => "apel", "c" => "pisang"];
asort($buahAsli);
echo "<br>asort() -> urut naik (key tetap): ";
var_dump($buahAsli);
arsort($buahAsli);
echo "<br>arsort() -> urut turun (key tetap): ";
var_dump($buahAsli);
ksort($buahAsli);
echo "<br>ksort() -> urut berdasarkan key (naik): ";
var_dump($buahAsli);
krsort($buahAsli);
echo "<br>krsort() -> urut berdasarkan key (turun): ";
var_dump($buahAsli);
?>