<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ella"] = "160";
$height["Frank"] = "172";
$height["Grace"] = "168";
$height["Helen"] = "175";

echo "<h3>Daftar tinggi badan (Array \$height):</h3>";
foreach($height as $x => $x_value) {
    echo $x . " is " . $x_value . " cm tall<br>";
}

$keys = array_keys($height);
$lastKey = end($keys);
echo "Indeks terakhir dari array \$height: " . $lastKey . "<br>";
echo "Nilainya: " . $height[$lastKey] . " cm<br><br>";

unset($height["Barry"]);

echo "<h3>Setelah menghapus 1 data (Barry):</h3>";
foreach($height as $x => $x_value) {
    echo $x . " is " . $x_value . " cm tall<br>";
}
echo "<br>";

$keys = array_keys($height);
$lastKey = end($keys);
echo "Indeks terakhir sekarang: " . $lastKey . "<br>";
echo "Nilainya sekarang: " . $height[$lastKey] . " cm<br><br>";

$weight = array("Andy"=>"65", "Barry"=>"70", "Charlie"=>"68");

echo "<h3>Daftar berat badan (Array \$weight):</h3>";
foreach($weight as $key => $val) {
    echo $key . " weighs " . $val . " kg<br>";
}
echo "<br><br>";

$values = array_values($weight);
$keys = array_keys($weight);
echo "Data ke-2 dari array \$weight adalah:<br>";
echo $keys[1] . " = " . $values[1] . " kg";
?>
