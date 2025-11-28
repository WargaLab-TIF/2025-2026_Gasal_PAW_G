<?php
$arr1 = ["a", "b", "c"];
$arr2 = ["d", "e", "f"];

// 3.6.1 array_push()
array_push($arr1, "g");
print_r($arr1);
echo "<br>";

// 3.6.2 array_merge()
$merged = array_merge($arr1, $arr2);
print_r($merged);
echo "<br>";

// 3.6.3 array_values()
$values = array_values($merged);
print_r($values);
echo "<br>";

// 3.6.4 array_search()
echo "Index dari 'e': " . array_search("e", $merged) . "<br>";

// 3.6.5 array_filter()
$filtered = array_filter($merged, function($v) {
    return $v > "b";
});
print_r($filtered);
echo "<br>";

// 3.6.6 Sorting
sort($merged);
echo "Setelah sort: ";
print_r($merged);
echo "<br>";

rsort($merged);
echo "Setelah rsort: ";
print_r($merged);
?>