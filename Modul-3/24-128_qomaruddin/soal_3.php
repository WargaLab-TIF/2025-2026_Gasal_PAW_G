<?php

echo("---menambahan nilai baru---<br>");
$height = array(
    "andi" => "176",
    "barry" => "165",
    "charlie" => "170"
);
$height["qomar"] = "180";
$height["lail"] = "190";
$height["qodir"] = "185";
$height["faisal"] = "160";
$height["riski"] = "150";
$key = array_key_last($height);
$value = $height[$key];
echo"key: $key <br>value : $height[$key] <br>";

echo("<br>---setelah data di hapus---<br>");
unset($height["andi"]);
$key = array_key_last($height);
$value = $height[$key];
echo"key: $key <br>value : $height[$key]<br>";

echo("<br>---array baru---<br>");
$weight = array(
    "nama" => "qomar",
    "umur" => 19,
    "alamat" => "pamekasan"
);
$key = array_keys($weight);
$key_2 = $key[1];
echo "key : $key_2 <br>value : $weight[$key_2]";
?>