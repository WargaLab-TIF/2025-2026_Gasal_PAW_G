<?php
echo("---setelah ditambah nilai baru---<br>");
$height = array(
    "andi" => "176",
    "barry" => "165",
    "charlie" => "170"
);
$jumlah_dt = count($height);
for($i = 0; $i < $jumlah_dt; $i++){
    $keys = array_keys($height);
    $key = $keys[$i];
    echo"key = $key, value = $height[$key] <br>";
    if($i < 5){
        $height[$i] = "value_$i";
        $jumlah_dt = count($height);
    }
}

echo("<br>---array baru---<br>");
$weight = array(
    "andi" => "176",
    "barry" => "165",
    "charlie" => "170"
);
$jumlah_dt = count($weight);
for($i = 0; $i < $jumlah_dt; $i++){
    $keys = array_keys($weight);
    $key = $keys[$i];
    echo"key = $key, value = $weight[$key] <br>";
}
?>