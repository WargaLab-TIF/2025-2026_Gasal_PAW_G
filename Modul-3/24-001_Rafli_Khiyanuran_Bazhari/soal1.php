<?php
// Skrip dasar untuk deklarasi dan akses array terindeks
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".<br><br>";

// Pertanyaan 3.1.1
// Menambahkan 5 data baru ke array $fruits
// Menampilkan nilai dengan indeks tertinggi
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo "<strong>Array \$fruits setelah ditambah 5 data:</strong><br>";
print_r($fruits);
echo "<br>";

$highest_index = count($fruits) - 1;
echo "<strong>Nilai dengan indeks tertinggi:</strong> " . $fruits[$highest_index] . "<br>";
echo "<strong>Indeks tertinggi:</strong> " . $highest_index . "<br><br>";

// Pertanyaan 3.1.2
// Menghapus 1 data tertentu (misalnya "Cherry" pada indeks 2)
// Menampilkan nilai dengan indeks tertinggi setelah penghapusan
$index_to_remove = 2;
$removed_item = $fruits[$index_to_remove];
unset($fruits[$index_to_remove]);
$fruits = array_values($fruits); // Reindex array

echo "<strong>Data yang dihapus:</strong> " . $removed_item . " (indeks " . $index_to_remove . ")<br>";
echo "<strong>Array \$fruits setelah dihapus 1 data:</strong><br>";
print_r($fruits);
echo "<br>";

$highest_index_after = count($fruits) - 1;
echo "<strong>Nilai dengan indeks tertinggi setelah penghapusan:</strong> " . $fruits[$highest_index_after] . "<br>";
echo "<strong>Indeks tertinggi setelah penghapusan:</strong> " . $highest_index_after . "<br><br>";

// Pertanyaan 3.1.3
// Membuat array baru $veggies dengan 3 data
$veggies = array("Broccoli", "Carrot", "Spinach");

echo "<strong>Array \$veggies:</strong><br>";
print_r($veggies);
echo "<br>";

echo "<strong>Seluruh data dari array \$veggies:</strong><br>";
foreach($veggies as $index => $veggie) {
    echo "Indeks " . $index . ": " . $veggie . "<br>";
}
?>
