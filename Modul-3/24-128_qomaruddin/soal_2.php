<?php
$fruit = array("avocado","blueberry","cerry");
$panjang_arr = count($fruit);
for($i = 0; $i < $panjang_arr; $i++){
    if($i <= 5){
        $panjang_arr = count($fruit);
        array_push($fruit,"dt_baru ($i)");
    }
    echo "$fruit[$i] <br>";
    echo"panjang array saat ini : $panjang_arr <br>";
}

echo "<br> ---array baru---<br>";
$veggies = array("avocado","blueberry","cerry");
$arr_lenght = count($veggies);
for ($i = 0; $i < $arr_lenght; $i++){
    echo "$veggies[$i] <br>";
}   
?>