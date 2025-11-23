<?php
$arr1 = ["A", "B", "C"];
$arr2 = ["D", "E", "F"];

//array_push
array_push($arr1, "G");
echo "array_push: ";
print_r($arr1);
echo "<br><br>";

//array_merge
$gabung = array_merge($arr1, $arr2);
echo "array_merge: ";
print_r($gabung);
echo "<br><br>";

//array_values
echo "array_values: ";
print_r(array_values($gabung));
echo "<br><br>";

// array_search
$cari = array_search("E", $gabung);
echo "array_search: E ada di indeks ke-$cari<br><br>";

//array_filter
$angka = [1, 2, 3, 4, 5, 6];
$genap = array_filter($angka, fn($n) => $n % 2 == 0);
echo "array_filter (bilangan genap): ";
print_r($genap);
echo "<br><br>";

// Sorting
sort($gabung);
echo "Hasil sort ascending: ";
print_r($gabung);
?>