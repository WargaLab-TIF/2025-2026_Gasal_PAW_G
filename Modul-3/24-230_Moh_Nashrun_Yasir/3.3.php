<?php 
// Membuat array asosiatif tinggi badan
$height = ["Andi" => 176, "Beni" => 165, "Candra" => 170];

// Menampilkan salah satu data
echo "Andy is " . $height["Andi"] . " cm tall";
echo "<hr>";

// ===== 3.3.1 Tambahkan 5 data baru =====
$height["Joko"] = 172;
$height["Lukman"] = 165;
$height["Farhan"] = 180;
$height["Nasrun"] = 169;
$height["Aak"] = 178;

// Menampilkan nilai indeks terakhir
$kunciTerakhir1 = array_key_last($height);
echo "Tinggi terakhir setelah menambah 5 data: " . $height[$kunciTerakhir1] . " cm";
echo "<hr>";

// 3.3.2
array_pop($height);
$lastDataKey2 = array_key_last($height);
echo "Nilai indeks terakhir setelah menghapus 1 data: ".$height[$lastDataKey2];
echo "<hr>";

// 3.3.3
$weight = ["Andy" => "67", "Barry" => "72", "Charlie" => "65"];
echo "Data ke-2: Berat badan Barry adalah ". $weight["Barry"] . " kg";
?>