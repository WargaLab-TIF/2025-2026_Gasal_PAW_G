<h1>3.6.1</h1>
<?php
$colors = array("red", "green");
array_push($colors, "blue", "yellow");
print_r($colors);
?>
<h1>3.6.2</h1>
<?php
$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green", "shape" => "circle", 4);
$result = array_merge($array1, $array2);
print_r($result);
?>
<h1>3.6.3</h1>
<?php
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
print_r(array_values($age));
?>
<h1>3.6.4</h1>
<?php
$cars = array("Volvo", "BMW", "Toyota");
$key = array_search("BMW", $cars);
echo $key;
?>
<h1>3.6.5</h1>
<?php
function isEven($var) {
    return ($var % 2 == 0);
}
$numbers = array(1, 2, 3, 4, 5, 6, 7, 8);
print_r(array_filter($numbers, "isEven"));
?>
<h1>3.6.6</h1>
<?php
$numbers = array(4, 6, 2, 22, 11);
sort($numbers);
print_r($numbers);
echo "<br><br>";
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
asort($age);
print_r($age);
?>
 
