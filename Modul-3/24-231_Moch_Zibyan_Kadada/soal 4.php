<?php
$height = array("Andy"=>"176", "Bary"=>"165", "Charlie"=>"170");

foreach ($height as $x => $x_value) {
    echo "key=" . $x . ", Value=" . $x_value;
    echo "<br>"; 
}

echo "<hr>";


//3.4.1
$height["Biiyan"] = "160";
$height["Hakim"] = "172";
$height["Firman"] = "165";
$height["Riyan"] = "180";
$height["Bima"] = "169";
foreach($height as $x => $x_value) {
    echo "Key = " . $x . ", Value =" . $x_value . " cm<br>";
}

echo "<hr>";

//3.4.2
$weight = array("Biyan"=>"55", "Bima"=>"65", "Yusron"=>"70");
foreach ($weight as $x => $x_value) {
    echo "Key = " . $x . ", Value = " . $x_value . " kg<br>";
}
?>