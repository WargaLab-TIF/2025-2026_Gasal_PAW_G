<?php
$height = array("Andy"=>"176", "Bary"=>"165", "Charlie"=>"170");
echo "Andy is". $height['Andy']. "cm tall";

echo "<hr>";

//3.3.1
$height["Biiyan"] = 160;
$height["Hakim"] = 172;
$height["Firman"] = 165;
$height["Riyan"] = 180;
$height["Bima"] = 169;
var_dump($height);
$last_key = array_key_last($height);
echo "Dengan indeks terakhir: $last_key" . "<br>";
echo "Berapa indeks terakhir dari array height: " . $height[$last_key] . " cm\n" . "<br>";

echo "<hr>";    

//3.3.2
array_splice($height, 1, 1);
foreach($height as $x =>$value) {
    echo "$x => $value cm" . "<br>";
}
$last_key = array_key_last($height);
echo "Dengan indeks terakhir: $last_key" . "<br>";
echo "Berapa indeks terakhir dari array height: " . $height[$last_key] .  " cm" . "<br>";

echo "<hr>";

//3.3.3
$weight = array("Biyan"=>"55", "Bima"=>"65", "Yusron"=>"70");
foreach($weight as $y => $value) {
    echo "$y => $value kg<br>";
}
$hasil = array_keys($weight);
$jadi = $hasil[1];
echo "\n\nData ke-2 dari array weight adalah:\n ";
echo "$jadi => " . $weight[$jadi] . " kg\n";

echo "<hr>";
?>