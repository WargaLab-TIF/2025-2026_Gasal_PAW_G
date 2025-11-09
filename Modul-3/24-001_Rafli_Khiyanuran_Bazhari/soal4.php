<?php
// Skrip dasar: foreach untuk menampilkan key dan value
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

foreach($height as $key => $value) {
	echo "Key= " . $key . ", Value= " . $value . "<br>";
}
echo "<br>";

// 3.4.1 Tambahkan 5 data baru
$newItems = array(
	"David" => "180",
	"Eva" => "162",
	"Frank" => "175",
	"Grace" => "168",
	"Henry" => "185"
);
foreach($newItems as $k => $v) {
	$height[$k] = $v;
}

echo "<strong>Setelah tambah 5 data (foreach yang sama tetap bekerja):</strong><br>";
foreach($height as $key => $value) {
	echo "Key= " . $key . ", Value= " . $value . "<br>";
}

echo "<br>";

// 3.4.2 Buat array baru $weight (3 data) dan tampilkan semuanya dengan foreach
$weight = array("Alice"=>"55", "Bob"=>"70", "Carol"=>"62");

echo "<strong>Array baru \$weight (ditampilkan dengan foreach yang sama):</strong><br>";
foreach($weight as $person => $kg) {
	echo $person . " => " . $kg . " kg<br>";
}
?>


