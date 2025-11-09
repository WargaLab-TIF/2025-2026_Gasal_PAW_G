<?php
// 3.6.1 array_push()
echo "<h3>3.6.1 array_push()</h3>";
$fruits = ["Apple", "Banana"];
array_push($fruits, "Cherry", "Date");
echo "Hasil array_push: ";
print_r($fruits);
echo "<br><br>";

// 3.6.2 array_merge()
echo "<h3>3.6.2 array_merge()</h3>";
$a = ["x", "y"];
$b = ["z"];
$merged = array_merge($a, $b);
echo "Hasil array_merge: ";
print_r($merged);
echo "<br><br>";

// 3.6.3 array_values()
echo "<h3>3.6.3 array_values()</h3>";
$assoc = ["Andy"=>176, "Barry"=>165, "Charlie"=>170];
$values = array_values($assoc);
echo "Hasil array_values (reset indeks numerik): ";
print_r($values);
echo "<br><br>";

// 3.6.4 array_search()
echo "<h3>3.6.4 array_search()</h3>";
$indexBanana = array_search("Banana", $fruits);
echo "Index 'Banana' pada \$fruits: " . var_export($indexBanana, true) . "<br>";
$key165 = array_search(165, $assoc);
echo "Key untuk nilai 165 pada \$assoc: " . var_export($key165, true) . "<br><br>";

// 3.6.5 array_filter()
echo "<h3>3.6.5 array_filter()</h3>";
$numbers = [1,2,3,4,5,6,7,8,9,10];
$even = array_filter($numbers, function($n){ return $n % 2 === 0; });
echo "Bilangan genap hasil array_filter: ";
print_r(array_values($even));
echo "<br><br>";

// 3.6.6 Berbagai fungsi sorting
echo "<h3>3.6.6 Fungsi Sorting</h3>";
$toSort = ["Orange", "Apple", "Banana", "Grape"];
$nums = [3, 1, 4, 2];
$assocSort = ["d"=>4, "a"=>1, "c"=>3, "b"=>2];

$tmp = $toSort; sort($tmp); echo "sort (nilai naik): "; print_r($tmp); echo "<br>";
$tmp = $toSort; rsort($tmp); echo "rsort (nilai turun): "; print_r($tmp); echo "<br>";
$tmp = $assocSort; asort($tmp); echo "asort (asos. nilai naik, jaga key): "; print_r($tmp); echo "<br>";
$tmp = $assocSort; arsort($tmp); echo "arsort (asos. nilai turun, jaga key): "; print_r($tmp); echo "<br>";
$tmp = $assocSort; ksort($tmp); echo "ksort (urut key naik): "; print_r($tmp); echo "<br>";
$tmp = $assocSort; krsort($tmp); echo "krsort (urut key turun): "; print_r($tmp); echo "<br>";

?>


