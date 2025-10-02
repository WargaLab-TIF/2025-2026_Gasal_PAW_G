<?php
//soal 10

function balikString($inputString) {
    $stringTerbalik = strrev($inputString);
    echo $stringTerbalik;
}

$stringAsli = "Hello world!";
balikString($stringAsli);
?>
