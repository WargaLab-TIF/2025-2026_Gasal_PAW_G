<h1>3.3.1</h1>
<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

// Menambah 5 data baru
$height["David"] = "180";
$height["Erick"] = "175";
$height["Frank"] = "168";
$height["George"] = "182";
$height["Harry"] = "179";
echo "Nilai dengan indeks terakhir adalah: " . end($height) . "<br>";
?>


<h1>3.3.2</h1>

<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
unset($height["Barry"]);
echo "Nilai dengan indeks terakhir adalah: " . end($height) . "<br>";
?>

<h1>3.3.3</h1>

<?php
// Buat array baru dengan nama $weight dan 3 data
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "72");

echo "Data ke-2 dari array \$weight adalah: " . $weight["Barry"] . "<br>";
?>