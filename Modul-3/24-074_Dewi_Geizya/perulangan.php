<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Data tinggi awal:<br>";
foreach ($height as $nama => $tinggi) {
    echo "Key = " . $nama . ", Value = " . $tinggi . "<br>";
}

// 3.4.1
$heightBaru = array(
    "Doni" => "180",
    "Bintang" => "169",
    "Satria" => "175",
    "Fawaz" => "160",
    "Rosi" => "168"
);
$height = array_merge($height, $heightBaru);
echo "<br>Data setelah penambahan 5 orang:<br>";
foreach ($height as $nama => $tinggi) {
    echo "Key = " . $nama . ", Value = " . $tinggi . "<br>";
}


// 3.4.2 
$weight = array("Andy" => 60, "Barry" => 55, "Charlie" => 65);
echo "<br>Nama dan berat badan:<br>";
foreach ($weight as $nama => $berat) {
    echo "Key = " . $nama . ", Value = " . $berat . " kg<br>";
}
?>
