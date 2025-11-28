<?php 
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

foreach($height as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
echo "<hr>";

// 3.4.1 tambah 5 data
$height["Joko"] = 172;
$height["Lukman"] = 165;
$height["Farhan"] = 180;
$height["Nasrun"] = 169;
$height["Aak"] = 178;

foreach($height as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
echo "<hr>";

// 3.4.2 array berat badan
$weight = ["Andy" => "67", "Barry" => "72", "Charlie" => "65"];
foreach($weight as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
?>