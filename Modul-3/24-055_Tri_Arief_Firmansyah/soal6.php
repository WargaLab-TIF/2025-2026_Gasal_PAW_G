<?php
$data1 = ["A", "B", "C"];
$data2 = ["D", "E", "F"];

// 3.6.1 array_push
array_push($data1, "G");
echo "<h3>array_push()</h3>";
print_r($data1);

// 3.6.2 array_merge
$merged = array_merge($data1, $data2);
echo "<h3>array_merge()</h3>";
print_r($merged);

// 3.6.3 array_values
echo "<h3>array_values()</h3>";
print_r(array_values($merged));

// 3.6.4 array_search
$index = array_search("E", $merged);
echo "<h3>array_search()</h3>Posisi E: $index";

// 3.6.5 array_filter
echo "<h3>array_filter()</h3>";
$filtered = array_filter($merged, fn($val) => $val > "C");
print_r($filtered);

// 3.6.6 Sorting
echo "<h3>Sorting</h3>";
sort($merged);
print_r($merged);
?>
