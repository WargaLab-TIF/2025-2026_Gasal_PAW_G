<?php
echo "## Jawaban 3.3.1\n\n";
$height = ["Andy" => "176", "Supri" => "165", "Priyo" => "170"];

$height["David"] = "180";
$height["Angga"] = "172";
$height["Adit"] = "168";
$height["Iwan"] = "175";
$height["Aan"] = "182";

echo "Nilai dari data terakhir yang ditambahkan adalah: " . end($height) . " cm\n\n";
echo "<hr>";
echo "## Jawaban 3.3.2\n\n";
unset($height["Charlie"]);
echo "Setelah menghapus data, nilai dari data terakhir adalah: " . end($height) . " cm\n\n";
echo "<hr>";
echo "## Jawaban 3.3.3\n\n";

$weight = ["Andy" => 68, "Supri" => 60, "Priyo" => 65];

$weightValues = array_values($weight);
echo "Data ke-2 dari array \$weight adalah: " . $weightValues[1] . " kg\n";
?>