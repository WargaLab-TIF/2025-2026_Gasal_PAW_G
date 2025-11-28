<?php
$fruits = array("Avocado", "Bluberry", "Cherry");
$arrlength = count($fruits);
for ($x = 0;$x < $arrlength;$x++){
    echo $fruits[$x];
    echo "<br>";
}
$tambah = array("Mango", "Strawberry", "Banana", "Apple", "Watermelon");
for ($y = 0;$y < count($tambah);$y++){
    array_push($fruits,$tambah[$y]);
}
echo "<br>";
$arrlength = count($fruits);
for ($x = 0;$x < $arrlength;$x++){
    echo $fruits[$x];
    echo "<br>";
}
/* Tidak ada perubahan yang dilakukan di perulangan for tersebut karena untuk
menampilkan seluruh data setelah menambahkan 5 data baru sama halnya dengan menampilkan 
data sebelum menambahkan 5 data baru. */

echo "<hr>";

$veggies = array("Carrot", "Broccoli", "Tomato");
$arrlength = count($veggies);
for ($x = 0; $x < $arrlength; $x++) {
    echo $veggies[$x];
    echo "<br>";
}

/* Saya hanya menyalin perulangan yang sebelumnya sudah dibuat dan hanya mengubah
sedikit pada perulangan tersebut yaitu di bagian echo $fruits yang saya ubah menjadi echo $veggies
dan saya juga mengubah sesuatu di luar perulangan yaitu di bagian arrlenght yang awalnya count($fruits)
menjadi count($veggies).  */
?>