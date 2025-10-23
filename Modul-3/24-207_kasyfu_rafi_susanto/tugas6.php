<?php

$word = array("anu","ani","ana");
$werd = array(1,2,3);

echo "tugas 3.6.1 <br>";
array_push($word,"agus");
foreach ($word as $wd){
    echo $wd . "<br>";
}
echo "<br>";
echo "tugas 3.6.2 <br>";
$merge = array_merge($word,$werd);
foreach ($merge as $mg){
    echo $mg . "<br>";
}
echo "<br>";
echo "tugas 3.6.3 <br>";
$value = array_values($word);
echo $value[0];
echo "<br>";

echo "<br>";
echo "tugas 3.6.4 <br>";
$src = array_search("anu",$word);
echo $src;
echo "<br>";

echo "<br>";
echo "tugas 3.6.5 <br>";
$flt  = array_filter($werd,function($f){
    return $f % 2 == 0;
});
print_r($flt);