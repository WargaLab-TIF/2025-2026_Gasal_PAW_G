<?php
$height = array(
    "andy"=>"176",
    "barry"=>"165",
    "charlie"=>"170",
);
foreach($height as $x=>$x_value){
    echo "key=". $x.",value=".$x_value;
    echo "<br>";
}echo "<br>";
//3.4.1
$height["mumun"]="174";
$height["dina"]="167";
$height["larry"]="164";
$height["titin"]="176";
$height["dila"]="172";
foreach($height as $x=>$x_value){
    echo "key= ". $x.", value= ".$x_value;
    echo "<br>";
}echo "tidak karena perulagan yang ini langsung mengikuti berapa banyak isi dari arraynya";
//3.4.2
echo "<br><br>";
$weight = array(
    "budi"=>50,
    "jumaidi"=>60,
    "dira"=>65
);
foreach($weight as $x=>$x_value){
    echo "key= ". $x.", value= ".$x_value;
    echo "<br>";
}echo "iya memodifikasinya yaitu hanya mengubah variabelnya ";




