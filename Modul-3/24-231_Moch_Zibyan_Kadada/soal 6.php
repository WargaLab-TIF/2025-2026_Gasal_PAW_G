<?php
//3.6.1
$fruits = array("Apple", "Banana", "Mango");
echo "Array awal: ";
print_r($fruits);
echo "<br>";

array_push($fruits, "Melon", "Lemon");
echo "Array setelah array_push(): ";
print_r($fruits);
echo "<br><br>";
echo "<hr>";

//3.6.2
$veggies = array("Carrot", "Broccoli", "Spinach");
$merged = array_merge($fruits, $veggies);
echo "Hasil penggabungan array fruits dan veggies:<br>";
print_r($merged);
echo "<br><br>";
echo "<hr>";

//3.6.3;
$student = array("Name" => "Biyan", "NIM" => "24231", "Prodi" => "Informatika");
echo "Array asosiatif:<br>";
print_r($student);
echo "<br>";

$values = array_values($student);
echo "Hasil array_values() (mengambil hanya nilai):<br>";
print_r($values);
echo "<br><br>";
echo "<hr>";

//3.6.4
$numbers = array(10, 20, 30, 40, 50);
$search = array_search(30, $numbers);
echo "Isi array numbers: ";
print_r($numbers);
echo "<br>";
echo "Nilai 30 ditemukan pada indeks ke-$search<br><br>";
echo "<hr>";

//3.6.5
$ages = array(17, 20, 22, 15, 30, 25);
echo "Array usia awal: ";
print_r($ages);
echo "<br>";

$adult = array_filter($ages, function($age){
    return $age >= 18;
});
echo "Hasil array_filter() (usia >= 18): ";
print_r($adult);
echo "<br><br>";
echo "<hr>";

//3.6.6
$numbers2 = array(40, 10, 30, 50, 20);
echo "Array awal: ";
print_r($numbers2);
echo "<br>";

sort($numbers2);
echo "Hasil sort() (menaik): ";
print_r($numbers2);
echo "<br>";

rsort($numbers2);
echo "Hasil rsort() (menurun): ";
print_r($numbers2);
echo "<br>";

$assoc = array("b" => 30, "a" => 10, "c" => 20);
asort($assoc);
echo "Hasil asort() (menaik berdasarkan nilai): ";
print_r($assoc);
echo "<br>";

ksort($assoc);
echo "Hasil ksort() (menaik berdasarkan key): ";
print_r($assoc);
echo "<br>";

arsort($assoc);
echo "Hasil arsort() (menurun berdasarkan nilai): ";
print_r($assoc);
echo "<br>";

krsort($assoc);
echo "Hasil krsort() (menurun berdasarkan key): ";
print_r($assoc);
echo "<br>";
echo "<hr>";
?>