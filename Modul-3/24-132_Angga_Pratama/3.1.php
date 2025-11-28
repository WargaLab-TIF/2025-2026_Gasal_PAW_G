<?php
echo "## Jawaban 3.1.1\n\n";

$fruits = ["Avocado", "Blueberry", "Cherry"];

$fruits[] = "Dragonfruit";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

$indeksTertinggi = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi adalah: " . $fruits[$indeksTertinggi] . "\n";
echo "Indeks tertinggi dari array \$fruits adalah: " . $indeksTertinggi . "\n\n";

echo "<hr>";

echo "## Jawaban 3.1.2\n\n";

unset($fruits[1]);

echo "Setelah menghapus data, nilai dengan indeks tertinggi adalah: " . $fruits[$indeksTertinggi] . "\n";
echo "Indeks tertinggi dari array \$fruits setelah unset() adalah: " . $indeksTertinggi . "\n\n";

echo "<hr>";

echo "## Jawaban 3.1.3\n\n";

$veggies = ["Carrot", "Broccoli", "Spinach"];

echo "Seluruh data dalam array \$veggies adalah:\n";
print_r($veggies);
?>