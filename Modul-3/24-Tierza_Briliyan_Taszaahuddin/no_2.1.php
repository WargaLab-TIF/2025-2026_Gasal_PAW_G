<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

echo "Panjang data saat ini: " . $arrlength . "<br><br>";


for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

$tambahbuah = array("mangga", "apel", "melon", "semangka", "jeruk");

foreach ($tambahbuah as $way) {
    $fruits[] = $way;
}

echo "<br>Daftar buah setelah ditambahkan:<br>";

foreach ($fruits as $way) {
    echo "$way <br>";
}

$daftarSayur = ["Potato", "Lettuce", "Garlic"];
echo "<br>Daftar sayuran:<br>";

foreach ($daftarSayur as $s) {
    echo "* $s <br>";
}
?>
