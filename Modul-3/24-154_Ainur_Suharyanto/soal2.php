<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

array_push($fruits, "Mango", "Apple", "Orange", "Grapes", "Banana");

$arrayLength = count($fruits);

echo "<h3>(Array \$fruits):</h3>";
for ($x = 0; $x < $arrayLength; $x++) {
    echo $fruits[$x] . "<br>";
}

echo "<br>Panjang array \$fruits saat ini: " . $arrayLength . "<br>";
echo "Perulangan tidak perlu diubah karena menggunakan count(),<br>";
echo "sehingga jumlah data yang ditampilkan akan otomatis menyesuaikan isi array.<br><br>";

$veggies = array("Carrot", "Spinach", "Broccoli");

$veggieLength = count($veggies);
echo "<h3>(Array \$veggies):</h3>";
for ($x = 0; $x < $veggieLength; $x++) {
    echo $veggies[$x] . "<br>";
}

echo "<br>Tidak perlu menulis ulang skrip baru,<br>";
echo "cukup ubah nama array dan variabel panjangnya saja.<br>";
echo "Struktur perulangan FOR tetap sama karena prinsipnya sama untuk semua array.";
?>
