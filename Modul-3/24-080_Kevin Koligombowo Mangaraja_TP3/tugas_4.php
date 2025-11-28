<h1>3.4.1</h1>

<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

// Menambah 5 data baru
$height["David"] = "180";
$height["Erick"] = "175";
$height["Frank"] = "168";
$height["George"] = "182";
$height["Harry"] = "179";

// Skrip perulangan foreach akan otomatis menampilkan 8 data
foreach ($height as $x => $x_value) {
  echo "Key=" . $x . ", Value=" . $x_value;
  echo "<br>";
}
?>

<h1>3.4.2</h1>

<?php
// Buat array baru dengan nama $weight dan 3 data
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "72");

// Tampilkan seluruh data dari array $weight menggunakan perulangan foreach
foreach ($weight as $y => $y_value) {
  echo "Key=" . $y . ", Value=" . $y_value;
  echo "<br>";
}
?>
