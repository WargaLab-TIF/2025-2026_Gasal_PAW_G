<?php

$fruits = array("Avocado", "Blueberry", "Cherry");

//Tambahkan 5 data baru menggunakan perulangan FOR
for($i = 0; $i < 5; $i++) {
    $fruits[] = "New Fruit " . ($i + 1);
}
$arrayLength = count($fruits);

//nah disini untuk menampilkan seluruh data dalam array $fruits
echo "<h3>Daftar Buah (Array \$fruits)</h3>";
for($x = 0; $x < $arrayLength; $x++) {
    echo $fruits[$x] . "<br>";
}

//jumlah data array
echo "<br><b>Panjang array \$fruits saat ini:</b> " . $arrayLength . " elemen.<br>";
echo "Tidak perlu ubah struktur for, karena count() otomatis menghitung panjang array.<br><br>";


//array barunya
$veggies = array("Carrot", "Broccoli", "Spinach");

//panjang array veggies
$veggiesLength = count($veggies);

// menampilkan seluruh data array veggies menggunakan perulangan FOR
echo "<h3>Daftar Sayuran (Array \$veggies)</h3>";
for($y = 0; $y < $veggiesLength; $y++) {
    echo $veggies[$y] . "<br>";
}
echo "<br><b>Panjang array \$veggies:</b> " . $veggiesLength . " elemen.<br>";
echo "Struktur for sama seperti sebelumnya, jadinya ya saya hanya ganti nama array dan data.<br>";
?>
