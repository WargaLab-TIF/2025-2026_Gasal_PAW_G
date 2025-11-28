<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
for ($i = 0; $i < count($fruits); $i++) {
    echo $fruits[$i];
    echo "<br>";
}

// 3.2.1 Tambahkan 5 data baru menggunakan FOR
for ($i = 0; $i < 5; $i++) {
    $fruits[] = "Fruit" . ($i + 1);
}

// Tampilkan seluruh data
echo "<br> Jumlah data fruits: " . count($fruits) . "<br>";
echo "<br> Seluruh data fruits:<br>";
for ($i = 0; $i < count($fruits); $i++) {
    echo $fruits[$i];
    echo "<br>";
}
// Tidak perlu ubah loop FOR karena count() menyesuaikan jumlah elemen

// 3.2.2 Array baru $veggies
$veggies = array("Carrot", "Cabbage", "Spinach");
echo "<br>Data veggies:<br>";
for ($i = 0; $i < count($veggies); $i++) {
    echo $veggies[$i];
    echo "<br>";
}
// Tidak perlu ubah loop FOR karena count() menyesuaikan jumlah elemen
?>