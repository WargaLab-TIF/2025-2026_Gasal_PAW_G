<?php
$fruit=array ("avocado","blueberry","cherry");
echo "i like ". $fruit[0]. ", ".$fruit[1]." and ".$fruit[2].".". "<br>";
//3.1.1
$fruit[]="strawberry";
$fruit[]="manggo";
$fruit[]="banana";
$fruit[]="apple";
$fruit[]="pinaple";
$index1=count($fruit);
echo($fruit[$index1-1])."<br>";
echo "index tertinggi pada variable $ fruit adlah ".$index1-1 . "<br>";
//3.1.2
unset($fruit[7]);
$index2=count($fruit);
echo ($fruit[$index2-1]). "<br>";
echo "index tertinggi pada variable $ fruit adlah ".$index2-1 . "<br>";
//3.1.3
$veggies=array("bayem","kangkung","brocoli");
var_dump($veggies);
