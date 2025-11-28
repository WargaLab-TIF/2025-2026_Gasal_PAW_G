<?php
echo "<h2>3.3. Array Asosiatif</h2>";

// Deklarasi array asosiatif
$height = array(
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
);
echo "Array awal: ";
print_r($height);

// 3.3.1. Tambah 5 data baru
echo "<h3>3.3.1. Tambah 5 Data Baru</h3>";
$height["David"] = 180;
$height["Eva"] = 168;
$height["Frank"] = 175;
$height["Grace"] = 162;
$height["Henry"] = 178;

echo "Array setelah tambah 5 data: ";
print_r($height);

// Ambil nilai terakhir
end($height);
$lastKey = key($height);
$lastValue = current($height);
echo "Nilai dengan indeks terakhir: $lastKey => $lastValue<br>";

// 3.3.2. Hapus 1 data tertentu
echo "<h3>3.3.2. Hapus 1 Data</h3>";
unset($height["Charlie"]);
echo "Array setelah hapus Charlie: ";
print_r($height);

// Ambil nilai terakhir setelah penghapusan
end($height);
$lastKey = key($height);
$lastValue = current($height);
echo "Nilai dengan indeks terakhir: $lastKey => $lastValue<br>";

// 3.3.3. Array weight
echo "<h3>3.3.3. Array Weight</h3>";
$weight = array(
    "Andy" => 70,
    "Barry" => 65,
    "Charlie" => 68
);
echo "Data ke-2 dari array weight: " . $weight["Barry"] . "<br>";
?>