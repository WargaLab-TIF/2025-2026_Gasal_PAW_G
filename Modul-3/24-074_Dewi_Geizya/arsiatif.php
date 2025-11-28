<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Data awal array \$height:<br>";
foreach ($height as $nama => $tinggi) {
    echo "$nama = $tinggi cm<br>";
}
echo "<br>";


// 3.3.1 
$heightBaru = array("Doni" => "180", "Bintang" => "169", "Satria" => "175", "Fawaz" => "160", "Rosi" => "168");
$heightGabungan = array_merge($height, $heightBaru);
echo "Data setelah digabung:<br>";
foreach ($heightGabungan as $nama => $tinggi) {
    echo "$nama = $tinggi cm<br>";
}
$lastKey = array_key_last($heightGabungan);
echo "Data terakhir setelah digabung:" . $lastKey . " = " . $heightGabungan[$lastKey] . " cm" ;

// 3.3.2
unset($height["Bintang"]); 
echo "<br>Setelah menghapus 'Bintang':<br>";
foreach ($height as $nama => $tinggi) {
    echo "$nama = $tinggi cm<br>";
}
$lastKey = array_key_last($height);
echo "<br>Data terakhir: " . $lastKey . " = " . $height[$lastKey] . " cm<br>";


// 3.3.3 
$weight = array(50, 65, 90);
echo "<br>Data array \$weight:<br>";
for ($i = 0; $i < count($weight); $i++) {
    echo "Data ke-" . ($i + 1) . " = " . $weight[$i] . " kg<br>";
}
echo "<br>Data ke-2 dari \$weight: " . $weight[1] . " kg";
?>
