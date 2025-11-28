<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".<br>";

// 3.1.1 
array_push($fruits, "Grapes", "Stawberry", "Banana", "Apple", "Mango");
$highest_index = count($fruits) -1;
echo "Nilai dengan indeks tertinggi adalah: " . $fruits[$highest_index] . "<br>";
echo "Indeks tertinggi dari array \$fruits adalah: " . $highest_index . "<br><br>";

// 3.1.2 
unset($fruits[6]); // menghapus "Cherry"
$highest_index_after_delete = max(array_keys($fruits));
echo "Setelah menghapus 1 data, nilai dengan indeks tertinggi adalah: " . $fruits[$highest_index_after_delete] . "<br>";
echo "Indeks tertinggi sekarang adalah: " . $highest_index_after_delete . "<br><br>";

// 3.1.3 
$veggies = array("Buku", "Pensil", "Penghapus");
echo "urutan array \$veggies:<br>";
foreach ($veggies as $index => $value) {
    echo "Index $index: $value<br>";
}
?>
