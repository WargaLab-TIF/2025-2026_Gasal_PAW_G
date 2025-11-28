<?php
echo "<h2>3.4. Array Asosiatif dengan Perulangan</h2>";

$height = array(
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
);

// 3.4.1. Tambah 5 data baru
echo "<h3>3.4.1. Tambah 5 Data Baru</h3>";
$height["David"] = 180;
$height["Eva"] = 168;
$height["Frank"] = 175;
$height["Grace"] = 162;
$height["Henry"] = 178;

echo "Tampilkan semua data dengan FOREACH:<br>";
foreach ($height as $key => $value) {
    echo "$key: $value cm<br>";
}

// 3.4.2. Array weight dengan perulangan
echo "<h3>3.4.2. Array Weight dengan Perulangan</h3>";
$weight = array(
    "Andy" => 70,
    "Barry" => 65,
    "Charlie" => 68
);

echo "Array weight dengan FOREACH:<br>";
foreach ($weight as $name => $w) {
    echo "$name: $w kg<br>";
}
?>