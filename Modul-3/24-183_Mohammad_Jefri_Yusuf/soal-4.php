<?php 
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

foreach($height as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
echo "<hr>";

// 3.4.1
$height["Jefri"] = "172";
$height["Lewis"] = "165";
$height["Fuzuka"] = "180";
$height["Jordan"] = "169";
$height["Edward"] = "178";

foreach($height as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
echo "<hr>";

// 3.4.2
$weight = ["Andy" => "67", "Barry" => "72", "Charlie" => "65"];
foreach($weight as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
?>