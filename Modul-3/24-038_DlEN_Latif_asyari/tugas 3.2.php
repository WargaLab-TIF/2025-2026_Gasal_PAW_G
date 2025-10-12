<?php
$fruit=array ("avocado","blueberry","cherry");
$arrlegth=count($fruit);

for($i=0;$i<$arrlegth;$i++){
    echo $fruit[$i];
    echo"<br>";
}
//3.2.1
$baru= array("nanas","apel","manga","melon","jambu");
for($i=0;$i<count($baru);$i++){
    $fruit[]=$baru[$i];
}
    echo "panjang dari variable $ fruit adalah ". count($fruit)-1;
echo "<br>";
for($i=0;$i<count($fruit);$i++){
    echo $fruit[$i];
    echo"<br>";
}
echo "iya, yaitu dengan mengubah tujuannya yaitu panjag dari $ fruit terbaru"."<br>";
//3.2.2
$veggies=["bayem","kangkung","seledri"];
for($i=0;$i<count($veggies);$i++){
    echo $veggies[$i];
    echo"<br>";
}echo "kita hanya perlu memodifikasi sedikit yaitu mengubah variabelnya ";