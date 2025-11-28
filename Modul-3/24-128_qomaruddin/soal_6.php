<?php
echo "Implementasi array_push()<br>";
$buah = ["apel", "jeruk"];
array_push($buah, "mangga", "pisang");
print_r($buah);


echo "<br><br>Implementasi array_merge()<br>";
$buah = ["apel", "jeruk"];
$sayur = ["wortel", "bayam"];
$hasilGabung = array_merge($buah, $sayur);
print_r($hasilGabung);


echo "<br><br>Implementasi array_values()<br>";
$nilai = ["a" => 90, "b" => 85, "c" => 78];
$hasilNilai = array_values($nilai);
print_r($hasilNilai);


echo "<br><br>Implementasi array_search()<br>";
$buah = ["apel", "jeruk", "mangga"];
$kunci = array_search("jeruk", $buah);
echo "Index dari 'jeruk' adalah: $kunci";


echo "<br><br>Implementasi array_filter()<br>";
$angka = [10, 25, 30, 45, 50];
$hasilFilter = array_filter($angka, function($n) {
    return $n > 30;  // ambil nilai lebih dari 30
});
print_r($hasilFilter);


echo "<br><br>Implementasi berbagai fungsi sorting<br>";

echo "sort() - Urut naik berdasarkan nilai<br>";
$angka = [4, 2, 8, 1];
sort($angka);
print_r($angka);
echo "<br><br>";

echo "rsort() - Urut turun berdasarkan nilai<br>";
$angka = [4, 2, 8, 1];
rsort($angka);
print_r($angka);
echo "<br><br>";

echo "asort() - Urut naik berdasarkan nilai (menjaga key)<br>";
$nilai = ["Ani" => 80, "Budi" => 95, "Cici" => 85];
asort($nilai);
print_r($nilai);
echo "<br><br>";

echo "ksort() - Urut naik berdasarkan key<br>";
$data = ["b" => 2, "a" => 5, "c" => 1];
ksort($data);
print_r($data);
echo "<br><br>";

echo "arsort() - Urut turun berdasarkan nilai (menjaga key)<br>";
arsort($nilai);
print_r($nilai);
echo "<br><br>";

echo "krsort() - Urut turun berdasarkan key<br>";
krsort($data);
print_r($data);
?>