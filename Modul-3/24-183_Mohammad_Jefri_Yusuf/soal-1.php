<?php 

$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like ". $fruits[0]. ", ". $fruits[1]. " and ". $fruits[2]. ".";
echo "<hr>";
// 3.1.1.

$fruits[] = "Guava";
$fruits[] = "Pineapple";
$fruits[] = "Watermelon";
$fruits[] = "Orange";
$fruits[] = "Mango";
$arrlength1 = count($fruits);
echo "Nilai indeks tertinggi setelah menambah 5 data: ". $fruits[$arrlength1-1];
echo "<hr>";

// 3.1.2
array_pop($fruits);
$arrlength2 = count($fruits);
echo "Nilai indeks tertinggi setelah menghapus 1 data: ". $fruits[$arrlength2-1];
echo "<hr>";

// 3.1.3
$veggies = ["Potato", "Letuce", "Garlic"];
print_r($veggies);
?>