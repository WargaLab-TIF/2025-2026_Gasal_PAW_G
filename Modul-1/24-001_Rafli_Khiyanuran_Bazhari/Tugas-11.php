<?php
//soal 11

function cariPosisiWorld($inputString) {
    $posisi = strpos($inputString, "world");
    echo $posisi;
}

$stringAsli = "Hello world!";
cariPosisiWorld($stringAsli);
?>
