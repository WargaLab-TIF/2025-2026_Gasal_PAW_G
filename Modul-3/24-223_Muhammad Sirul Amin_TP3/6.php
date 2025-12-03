<?php
//1. array_push()
$colors = ["red", "green"];
array_push($colors, "blue", "yellow");

//2. array_merge()
$arr1 = ["apple", "banana"];
$arr2 = ["mango", "pear"];
$fruits = array_merge($arr1, $arr2);

//3. array_values()
$assoc = ["first" => "PHP", "second" => "HTML", "third" => "CSS"];
$values = array_values($assoc);

//4. array_search()
$key = array_search("banana", $fruits);

//5. array_filter()
$nums = [1, 2, 3, 4, 5, 6];
$evens = array_filter($nums, function($n) {
    return $n % 2 == 0;
});

//6. sorting
$unsorted = [5, 2, 8, 1];
sort($unsorted);

// print
echo "<b>array_push():</b><br>";
print_r($colors);

echo "<b>array_merge():</b><br>";
print_r($fruits);

echo "<b>array_values():</b><br>";
print_r($values);

echo "<b>array_search():</b><br>";
echo "Posisi 'banana' ada di index: $key";

echo "<b>array_filter():</b><br>";
print_r($evens);

echo "<b>sort():</b><br>";
print_r($unsorted);
?>
