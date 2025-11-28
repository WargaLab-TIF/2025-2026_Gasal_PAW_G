<h1>3.2.1</h1>

<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Tambahkan 5 data baru
$fruits[] = "Grape";
$fruits[] = "Mango";
$fruits[] = "Orange";
$fruits[] = "Strawberry";
$fruits[] = "Watermelon";

$arrlength = count($fruits);

// Perulangan FOR tetap sama dan akan menampilkan 8 data
for($x = 0; $x < $arrlength; $x++) {
  echo $fruits[$x];
  echo "<br>";
}
?>

<h1>3.2.2</h1>

<?php
// Buat array baru dengan nama $veggies yang memiliki 3 buah data
$veggies = array("Carrot", "Broccoli", "Spinach");
$veglength = count($veggies);

// Tampilkan seluruh data dari array $veggies menggunakan perulangan FOR
for($x = 0; $x < $veglength; $x++) {
  echo $veggies[$x];
  echo "<br>";
}
?>


