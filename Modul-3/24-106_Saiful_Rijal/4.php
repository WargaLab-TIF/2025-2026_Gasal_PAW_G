<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

foreach($height as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
echo "<hr>";
// Menambahkan 5 data baru ===== 3.4.1 ======
$height["Dewi"] = "160";
$height["Eka"] = "170";
$height["Fani"] = "175";
$height["Gina"] = "180";
$height["Hani"] = "165";
foreach($height as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}

echo "<hr>";
// Membuat array baru weight ===== 3.4.2 ======
$weight = array("Andy" => "65", "Barry" => "55", "Charlie" => "60");
foreach($weight as $x => $x_value){
    echo "Key=". $x. ", Value=". $x_value;
    echo "<br>";
}
?>