<?php
function pengganti($kata,$awal,$ganti){
    return str_replace($awal,$ganti,$kata);
}
echo pengganti ("Hello world", "world", "dolly") . "<br>";

