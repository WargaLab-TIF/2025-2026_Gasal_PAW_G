<?php
echo "<h2>3.6. Eksplorasi Fungsi Array</h2>";

$numbers = [1, 2, 3, 4, 5];
$fruits = ["Apple", "Banana"];

// 3.6.1. array_push()
echo "<h3>3.6.1. array_push()</h3>";
array_push($numbers, 6, 7);
echo "Setelah array_push: ";
print_r($numbers);

// 3.6.2. array_merge()
echo "<h3>3.6.2. array_merge()</h3>";
$merged = array_merge($numbers, $fruits);
echo "Hasil array_merge: ";
print_r($merged);

// 3.6.3. array_values()
echo "<h3>3.6.3. array_values()</h3>";
$assocArray = ["a" => "Apple", "b" => "Banana", "c" => "Cherry"];
$reindexed = array_values($assocArray);
echo "Setelah array_values: ";
print_r($reindexed);

// 3.6.4. array_search()
echo "<h3>3.6.4. array_search()</h3>";
$searchKey = array_search("Banana", $fruits);
echo "Key untuk 'Banana': " . $searchKey . "<br>";

// 3.6.5. array_filter()
echo "<h3>3.6.5. array_filter()</h3>";
$evenNumbers = array_filter($numbers, function($value) {
    return $value % 2 == 0;
});
echo "Bilangan genap: ";
print_r($evenNumbers);

// 3.6.6. Fungsi sorting
echo "<h3>3.6.6. Fungsi Sorting</h3>";
$sortArray = [3, 1, 4, 1, 5, 9, 2, 6];

// sort() - ascending
$sorted = $sortArray;
sort($sorted);
echo "sort(): ";
print_r($sorted);

// rsort() - descending
$reverseSorted = $sortArray;
rsort($reverseSorted);
echo "rsort(): ";
print_r($reverseSorted);

// asort() - ascending dengan menjaga key
$assocSort = ["b" => 2, "a" => 1, "c" => 3];
asort($assocSort);
echo "asort(): ";
print_r($assocSort);

// ksort() - sorting berdasarkan key
$keySort = ["b" => 2, "a" => 1, "c" => 3];
ksort($keySort);
echo "ksort(): ";
print_r($keySort);
?>