<?php

$fruits =array("avocado","bluberry","Cherry");
echo "I like ".$fruits[0] . ",". $fruits[1]." and " .$fruits[2].".";
echo "<br>";

echo "tugas 3.1.1 <br>";
array_push($fruits,"Banana","Orange","Grape","Mango","Apple");
echo  "nilai dari index tertinggi = ". $fruits[count($fruits)-1] . "<br>";
echo "index tertinggi = ". (count($fruits)-0) . "<br>";
echo "<br>";

echo "tugas 3.1.2 <br>" ;
unset($fruits[7]);
echo  "nilai dari index tertinggi = ". $fruits[count($fruits)-1] . "<br>";
echo "index tertinggi = ". (count($fruits)-0) . "<br>";
echo "<br>";

echo "tugas 3.1.3 <br>" ;
$veggies = array("satu","dua","tiga");
foreach ($veggies as $veg){
    echo $veg;
    echo "<br>";
}
echo "<br>";