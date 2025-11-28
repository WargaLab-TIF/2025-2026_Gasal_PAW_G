<?php 

$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like ". $fruits[0]. ", ". $fruits[1]. " and ". $fruits[2]. ".";
echo "<hr>";
// 3.1.1.

array_push($fruits, "Guava", "Pineapple", "Watermelon", "Orange", "Mango");
$totalData1 = count($fruits);
$indeksTerakhir1 = $totalData1 - 1;
echo "Data pada indeks tertinggi setelah menambah 5 item: ". $fruits[$indeksTerakhir1];
echo "<hr>";

// 3.1.2
array_pop($fruits);
$totalData2 = count($fruits);
$indeksTerakhir2 = $totalData2 - 1;
echo "Data pada indeks tertinggi setelah menghapus 1 item: ". $fruits[$indeksTerakhir2];
echo "<hr>";

// 3.1.3
$sayuran = ["Potato", "Letuce", "Garlic"];
print_r($sayuran);
?>