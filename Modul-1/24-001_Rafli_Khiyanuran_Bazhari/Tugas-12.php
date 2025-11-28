<?php
//soal 12

function gantiKata($stringAsli, $cari, $ganti) {
    $stringBaru = str_replace($cari, $ganti, $stringAsli);
    echo $stringBaru;
}

$stringAsli = "Hello world!";
gantiKata($stringAsli, "world", "Dolly");
?>
