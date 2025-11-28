<?php
echo "<h1>Eksplorasi Fungsi Array dengan var_dump()</h1>";
$numbers1 = [1, 2, 3];
$numbers2 = [4, 5, 6];
$fruits = ["a" => "Apple", "b" => "Banana", "c" => "Cherry", "d" => "Banana"];
$people = [
    ["name" => "Andy", "age" => 20],
    ["name" => "Barry", "age" => 17],
    ["name" => "Charlie", "age" => 25],
    ["name" => "David", "age" => 17],
];

echo "<h2>3.6.1. Implementasi fungsi array_push()</h2>";
echo "<p>Menambahkan '4' dan '5' ke array.</p>";
array_push($numbers1, 4, 5);
echo '<pre>'; var_dump($numbers1); echo '</pre>';
echo "<hr>";


echo "<h2>3.6.2. Implementasi fungsi array_merge()</h2>";
echo "<p>Menggabungkan dua array.</p>";
$merged = array_merge($numbers1, $numbers2);
echo '<pre>'; var_dump($merged); echo '</pre>';
echo "<hr>";


echo "<h2>3.6.3. Implementasi fungsi array_values()</h2>";
echo "<p>Mengambil semua nilai dari array \$fruits.</p>";
$values = array_values($fruits);
echo '<pre>'; var_dump($values); echo '</pre>';
echo "<hr>";


echo "<h2>3.6.4. Implementasi fungsi array_search()</h2>";
echo "<p>Mencari 'Cherry' dalam array \$fruits dan menampilkan key-nya.</p>";
$key = array_search("Cherry", $fruits);
echo "Hasil pencarian key: ";
echo '<pre>'; var_dump($key); echo '</pre>';
echo "<hr>";


echo "<h2>3.6.5. Implementasi fungsi array_filter()</h2>";
echo "<p>Menyaring orang yang usianya 18 tahun atau lebih.</p>";
$adults = array_filter($people, function ($person) {
    return $person['age'] >= 18;
});
echo '<pre>'; var_dump($adults); echo '</pre>';
echo "<hr>";


echo "<h2>3.6.6. Implementasi berbagai fungsi sorting</h2>";
$sortExample = ["d" => "Lemon", "a" => "Orange", "b" => "Banana", "c" => "Apple"];

echo "<b>Array Awal:</b><br>";
echo '<pre>'; var_dump($sortExample); echo '</pre>';

echo "<br><b>sort() - Mengurutkan berdasarkan nilai:</b><br>";
$temp = $sortExample;
sort($temp);
echo '<pre>'; var_dump($temp); echo '</pre>';

echo "<br><b>asort() - Mengurutkan berdasarkan nilai, mempertahankan key:</b><br>";
$temp = $sortExample;
asort($temp);
echo '<pre>'; var_dump($temp); echo '</pre>';

echo "<br><b>ksort() - Mengurutkan berdasarkan key:</b><br>";
$temp = $sortExample;
ksort($temp);
echo '<pre>'; var_dump($temp); echo '</pre>';
echo "<hr>";
?>