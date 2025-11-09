<?php
// Skrip dasar untuk deklarasi dan akses array asosiatif
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
echo "Andy is " . $height['Andy']." cm tall.<br><br>";

// Pertanyaan 3.3.1
// Menambahkan 5 data baru ke array $height
// Menampilkan nilai dengan indeks terakhir
$height["David"] = "180";
$height["Eva"] = "162";
$height["Frank"] = "175";
$height["Grace"] = "168";
$height["Henry"] = "185";

echo "<strong>Array \$height setelah ditambah 5 data:</strong><br>";
print_r($height);
echo "<br>";

$last_key = array_key_last($height);
$last_value = $height[$last_key];
echo "<strong>Kunci terakhir:</strong> " . $last_key . "<br>";
echo "<strong>Nilai dengan indeks terakhir:</strong> " . $last_value . " cm<br>";
echo "<strong>Pesan lengkap:</strong> " . $last_key . " is " . $last_value . " cm tall.<br><br>";

// Pertanyaan 3.3.2
// Menghapus 1 data tertentu dari array $height
// Menampilkan nilai dengan indeks terakhir setelah penghapusan
$key_to_remove = "Barry";
$removed_value = $height[$key_to_remove];
unset($height[$key_to_remove]);

echo "<strong>Data yang dihapus:</strong> " . $key_to_remove . " (" . $removed_value . " cm)<br>";
echo "<strong>Array \$height setelah dihapus 1 data:</strong><br>";
print_r($height);
echo "<br>";

$last_key_after = array_key_last($height);
$last_value_after = $height[$last_key_after];
echo "<strong>Kunci terakhir setelah penghapusan:</strong> " . $last_key_after . "<br>";
echo "<strong>Nilai dengan indeks terakhir setelah penghapusan:</strong> " . $last_value_after . " cm<br>";
echo "<strong>Pesan lengkap:</strong> " . $last_key_after . " is " . $last_value_after . " cm tall.<br><br>";

// Pertanyaan 3.3.3
// Membuat array baru $weight dengan 3 data
// Menampilkan data ke-2 dari array $weight

$weight = array("Alice"=>"55", "Bob"=>"70", "Carol"=>"62");

echo "<strong>Array baru \$weight:</strong><br>";
print_r($weight);
echo "<br>";

$keys = array_keys($weight);
$second_key = $keys[1]; // Indeks 1 untuk data ke-2
$second_value = $weight[$second_key];

echo "<strong>Data ke-2 dari array \$weight:</strong><br>";
echo "<strong>Kunci:</strong> " . $second_key . "<br>";
echo "<strong>Nilai:</strong> " . $second_value . " kg<br>";
echo "<strong>Pesan lengkap:</strong> " . $second_key . " weighs " . $second_value . " kg<br><br>";
?>
