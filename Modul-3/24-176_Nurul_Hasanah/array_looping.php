<?php
$fruits = ["Anggur", "Cherry", "Nanas", "Mangga", "Durian"];

// Menambahkan 5 data baru pakai looping for
for ($i = 0; $i <5; $i++){
    $fruits[] = "Buah" . ($i + 1);
}

// Menampilkan semua data
echo "Jumlah data saat ini: " . count($fruits) . "<br>";
for ($i = 0; $i < count($fruits); $i++){
    echo $fruits[$i] . "<br>";
}

// Buat array veggies baru
$veggies = ["Kangkung", "Terong", "Cabe"];
echo "<br>Data veggies:<br>";
for ($i = 0; $i < count($veggies); $i++){
    echo $veggies[$i] . "<br>";
}

?>