<?php
// 3.2.1
$fruits = ["Avocado", "Blueberry", "Cherry"];
$arrleght = count($fruits);
$fruits_baru = ["Guava", "Banana", "Orange", "Manggo", "Apple"];
$arrleght_baru = count($fruits_baru);

for($i = 0; $i < $arrleght_baru; $i++){
    array_push($fruits, $fruits_baru[$i]);
}
$arrleght = count($fruits);
for($i = 0; $i < $arrleght; $i++){
    echo $fruits[$i];
    echo "<br>";
}

echo "panjang array fruits sekarang adalah = " . $arrleght . "<br>";
echo "Perlu menambahkan kode baru pada baris 5-10, membuat variabel fruits_baru yang menyimpan data baru dan variabel arrleght_baru yang menyimpan panjang dari fruits_baru kemudian membuat perulangan for untuk menambahkan data fruits_baru ke fruits setelah itu membuat variabel leght yang menampung panjang fruits baru";

echo "<br> <br>";

// 3.2.2
$vaggies = array("Bayam", "Wortel", "Sawi");
$arrleght2 = count($vaggies);

for($i = 0; $i < $arrleght2; $i++){
    echo $vaggies[$i];
    echo "<br>";
}
echo "Tidak perlu mambuat skrip baru hanya perlu memodifikasi codenya pada bagian variabel menjadi variabel vaggies"
?> 