<?php
$fruit = array("avocado","blueberry","cerry");
array_push($fruit,"baru_1","baru_2","baru_3","baru_4","baru_5");
$max_indek = 0;
$value = "";
foreach($fruit as $indeks => $nilai ){
    if($indeks > $max_indek){
        $max_indek = $indeks;
        $value = $fruit[$max_indek];
    }
}
echo"nilai dari indeks tertinggi : $value <br> dengan indeks : $max_indek <br>";
echo ("<br>---setelah dihapus--<br>");
array_pop($fruit);
$max_indek = 0;
$value = "";
foreach($fruit as $indeks => $nilai ){
    if($indeks > $max_indek){
        $max_indek = $indeks;
        $value = $fruit[$max_indek];
    }
}
echo"nilai dari indeks tertinggi : $value <br> dengan indeks : $max_indek <br>";

echo("<br>---array baru--- <br>");
$veggies = array("data_1","data_2", "data_3");
foreach($veggies as $nilai){
    echo "$nilai <br>";
}
?>