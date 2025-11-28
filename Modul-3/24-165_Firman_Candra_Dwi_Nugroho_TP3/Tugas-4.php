<?php
//================//
//     3.4.1      //
//================//
echo "3.4.1 <br>";
echo "<br>";

$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);


$height["David"] = "180";
$height["Eva"] = "160";
$height["Fikri"] = "175";
$height["Gina"] = "168";
$height["Hana"] = "162";

foreach($height as $key => $value) {
    echo "Key: " . $key . ", Value: " . $value . "<br>";
}

echo "<br><br>";


//================//
//     3.4.2      //
//================//
echo "3.4.2 <br>";
echo "<br>";

$weight = array(
    "Andy" => 65,
    "Barry" => 58,
    "Charlie" => 60
);

foreach($weight as $key => $value) {
    echo "Key: " . $key . ", Value: " . $value . " kg<br>";
}
?>
