<?php
echo "<h2>Eksplorasi Lanjut terhadap Array</h2>";

//array_push()
echo "<h3>1. Fungsi array_push()</h3>";
$buah = ["Apel", "Jeruk"];
array_push($buah, "Mangga", "Pisang");
print_r($buah);

echo "<br>";

//array_merge()
echo "<h3>2. Fungsi array_merge()</h3>";
$buah1 = ["Apel", "Jeruk"];
$buah2 = ["Mangga", "Pisang"];
$gabung = array_merge($buah1, $buah2);
print_r($gabung);

echo "<br>";

//array_values()
echo "<h3>3. Fungsi array_values()</h3>";
$buahAsos = ["a" => "Apel", "b" => "Jeruk", "c" => "Mangga"];
print_r(array_values($buahAsos));

echo "<br>";

//array_search()
echo "<h3>4. Fungsi array_search()</h3>";
$buahCari = ["Apel", "Jeruk", "Mangga"];
$hasil = array_search("Jeruk", $buahCari);
echo "Jeruk ditemukan di indeks: " . $hasil;

echo "<br>";

//array_filter()
echo "<h3>5. Fungsi array_filter()</h3>";
$angka = [1, 2, 3, 4, 5, 6];
$genap = array_filter($angka, function($n) {
    return $n % 2 == 0;
});
print_r($genap);

echo "<br>";

//Fungsi Sorting
echo "<h3>6. Fungsi Sorting</h3>";
$angkaSort = [3, 1, 4, 2, 5];

sort($angkaSort);
echo "Sort ascending: ";
print_r($angkaSort);

rsort($angkaSort);
echo "<br>Sort descending: ";
print_r($angkaSort);

$buahAssoc = ["b" => "Jeruk", "a" => "Apel", "c" => "Mangga"];
asort($buahAssoc);
echo "<br>asort() (urut nilai): ";
print_r($buahAssoc);

ksort($buahAssoc);
echo "<br>ksort() (urut kunci): ";
print_r($buahAssoc);
?>
