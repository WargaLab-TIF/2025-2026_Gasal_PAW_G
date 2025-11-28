<?php
// Implementasi fungsi array_push()!
// 3.6.1
$warna = array("red", "green");
array_push($warna, "blue", "yellow");
print_r($warna);
echo "<br> <br>";

// Implementasi fungsi array_merge()!
// 3.6.2
$arr1 = array("red", "green");
$arr2 = array("blue", "yellow");
print_r(array_merge($arr1,$arr2));
echo "<br> <br>";

// Implementasi fungsi array_values()!
// 3.6.3
$arr3 = array("Name" => "Aziz", "Age" => "19", "Jurusan" => "Teknik Informatika");
print_r(array_values($arr3));
echo "<br> <br>";

// Implementasi fungsi array_search()!
// 3.6.4
$arr4 = array("a" => "Mohammad", "b" => "Aziz", "c" => "Huzaini");
echo array_search("Aziz", $arr4);
echo "<br> <br>";

// Implementasi fungsi array_filter()!
// 3.6.5
function tes($var)
    {
        return($var & 1);
    }
$arr5 = array(1,3,2,3,4);
print_r(array_filter($arr5, "tes"));
echo "<br> <br>";

// Implementasi berbagai fungsi sorting pada array!
// 3.6.6
$array1 = [2, 3,4, 1, 6];
sort($array1);
var_dump($array1);
echo "<br>";
rsort($array1);
var_dump($array1);
echo "<br>";
$tinggi = [
    "Aziz" => 170,
    "Abdul" => 175,
    "Abu" => 173,
];
ksort($tinggi);
var_dump($tinggi);
?>