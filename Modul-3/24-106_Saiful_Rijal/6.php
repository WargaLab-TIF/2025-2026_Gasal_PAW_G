<?php
// Implementasi fungsi array_push() ====== 3.6.1 ======
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Eggplant", "Fig", "Grape", "Honeydew");
foreach ($fruits as $fruit) {
    echo $fruit;
    echo "<br>";
}
echo "<hr>";
// Implementasi fungsi array_merge() ====== 3.6.2 ======
$fruits = array("Avocado", "Blueberry", "Cherry");
$veggies = array("Asparagus", "Broccoli", "Cabbage");
$all = array_merge($fruits, $veggies);
foreach ($all as $item) {
    echo $item;
    echo "<br>";
}
echo "<hr>";

// Implementasi fungsi array_values() ====== 3.6.3 ======
$fruits = array("Avocado", "Blueberry", "Cherry");
$veggies = array("Asparagus", "Broccoli", "Cabbage");
$all = array_merge($fruits, $veggies);
$filtered = array_values($all);
foreach ($filtered as $item) {
    echo $item;
    echo "<br>";
}
echo "<hr>";

// Implementasi fungsi array_search() ====== 3.6.4 ======
$search = "Broccoli";
echo "$search is at index " . array_search($search, $all);
echo "<hr>";

// Implementasi fungsi array_filter() ====== 3.6.5 ======
$nilaiUts = array(
    [
        "nama" => "Rijal",
        "uts" => 80,
    ],
    [
        "nama" => "Saiful",
        "uts" => 90,
    ],
    [
        "nama" => "Adi",
        "uts" => 70,
    ],
    [
        "nama" => "Risa",
        "uts" => 50,
    ]
);
$filtered = array_filter($nilaiUts, function ($nilai) {
    return $nilai["uts"] >= 70;
});
echo "Daftar Yang Lulus UTS";
echo "<br>";
foreach ($filtered as $item) {
    echo $item["nama"] . " - " . $item["uts"];
    echo "<br>";
}
echo "<hr>";

// Implementasi berbagai fungsi sorting ====== 3.6.6 ======
$angka = [5,2,2,5,1,2,3];
// sort => mengurutkan array
sort($angka);
echo "<pre>";
print_r($angka);
echo "</pre>";

// rsort => mengurutkan array terbalik
rsort($angka);
echo "<pre>";
print_r($angka);
echo "</pre>";

// asort => mengurutkan array berdasarkan value
$nama = [
    "Rijal" => 80,
    "Saiful" => 90,
    "Adi" => 70,
    "Risa" => 50,
];
asort($nama);
echo "<pre>";
print_r($nama);
echo "</pre>";

// arsort => mengurutkan array berdasarkan value terbalik
arsort($nama);
echo "<pre>";
print_r($nama);
echo "</pre>";

// ksort => mengurutkan array berdasarkan key
ksort($nama);
echo "<pre>";
print_r($nama);
echo "</pre>";

// krsort => mengurutkan array berdasarkan key terbalik
krsort($nama);
echo "<pre>";
print_r($nama);
echo "</pre>";
?>