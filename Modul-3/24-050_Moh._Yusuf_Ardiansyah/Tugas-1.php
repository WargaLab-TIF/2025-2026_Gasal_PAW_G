<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . ", and " . $fruits[2] . ".";
echo "<br>";

// 3.1.1
$fruits[] = "Apple";
$fruits[] = "Melon";
$fruits[] = "Banana";
$fruits[] = "Grape";
$fruits[] = "Orange";

$jumlah_buah = count($fruits);
$indeks_tertinggi = $jumlah_buah - 1;
$buah_terakhir = $fruits[$indeks_tertinggi];

echo "<br>";
echo "Nilai dengan indeks tertinggi adalah: " . $buah_terakhir . "<br>";
echo "Indeks tertinggi dari array adalah: " . $indeks_tertinggi . "<br>";
echo "<br>";

// 3.1.2
unset($fruits[1]);

$indeks_tertinggi_baru = array_key_last($fruits);
$nilai_tertinggi_baru = $fruits[$indeks_tertinggi_baru];

echo "Nilai dengan indeks tertinggi setelah data dihapus adalah: " . $nilai_tertinggi_baru . "<br>";
echo "Indeks tertinggi dari array setelah data dihapus adalah: " . $indeks_tertinggi_baru;
echo "<br>";

// 3.1.3
$veggies = array("Carrot", "Potato", "Broccoli");
foreach ($veggies as $sayuran) {
    echo "<br>" . $sayuran;
}
?>