<?php
$fruits = array("avocado","blueberry","cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . ", and " . $fruits[2] . ".";
echo"<br>";
array_push($fruits,"manggo","banana","alpukat","kiwi","nanas");
$indeks = count($fruits);
echo "nilia dengan indeks tertinggi :" . $fruits[$indeks-1]."<br>";
echo "indeks tertinggi :". ($indeks-1)."<br>";
$fruits_hapus = "kiwi";
$cari= array_search($fruits_hapus,$fruits);
unset($fruits[$cari]);
$fruits = array_values($fruits);
$indeks_baru = count($fruits);
echo"nilai dengan indeks tertinggi :" . $fruits[$indeks_baru-1]."<br>";
echo "setelah menghapus ". $fruits_hapus . " indeks tertinggi sekarang : " . ($indeks_baru-1)."<br>";
$veggies = array("apel","jeruk","melon");
foreach($veggies as $value){
    echo $value . "<br>";
}
?>