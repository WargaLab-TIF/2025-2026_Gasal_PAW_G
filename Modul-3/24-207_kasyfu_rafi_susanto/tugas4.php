<?php

$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);
$height = array_merge($height,array(
    "agus" => "150",
    "rofik" => "190",
    "yani" => "200",
    "yuni" => "160",
    "yuyun" => "160"
));
$weight = array (
    "Ando" => 80,
    "Ben" => 75,
    "kevin" => 70
);
echo "tugas 3.4.1";
echo "<br>";
foreach ($height as $x => $x_value){
    echo "key = " . $x . " , Value = " . $x_value;
    echo "<br>";
}
echo "<br>";
echo "tugas 3.4.2";
echo "<br>";
foreach ($weight as $x => $x_value){
    echo "key = " . $x . " , Value = " . $x_value;
    echo "<br>";
}

