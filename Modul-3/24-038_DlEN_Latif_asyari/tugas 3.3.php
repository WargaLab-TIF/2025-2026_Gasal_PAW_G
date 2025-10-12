<?php
$height=array(
    "Andy"=>"176",
    "barry"=>"165",
    "charlie"=>"170"   
);echo "andy is ". $height["Andy"]. ' cm tall .'."<br>";


// 3.3.1 
$height["budi"] = 168;
$height["maimunah"] = 180;
$height["tono"] = 162;
$height["fatimah"] = 177;
$height["supratman"] = 160;

$keys = array_keys($height);
$indeks = count($height) - 1;
$last_key = $keys[$indeks];
echo "Indeks terakhir adalah: $last_key dengan tinggi " . $height[$last_key] . " cm.<br>";

// 3.3.2 
unset($height["supratman"]);


$keys = array_keys($height);
$indeks = count($height) - 1;
$last_key = $keys[$indeks];
echo "indeks terakhir adalah: $last_key dengan tinggi " . $height[$last_key] . " cm.<br>";

// 3.3.3 
$weight = array(65, 70, 55);
echo "Data ke-2 dari array weight adalah: " . $weight[1] . " kg.";
?>
