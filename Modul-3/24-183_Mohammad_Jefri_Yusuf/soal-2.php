<?php 
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
};
echo "<hr>";

// 3.2.1
$new_fruits =  ["Watermelon", "Pineapple", "Orange", "Mango", "Guava"];

for($i = 0; $i < count($new_fruits); $i++) {
    $fruits[] = $new_fruits[$i];
};

$arrlength2 = count($fruits);

for($x = 0; $x < $arrlength2; $x++) {
    echo $fruits[$x];
    echo "<br>";
};
echo "<hr>";

// 3.2.2
$veggies = ["Potato", "Letuce", "Garlic"];
for($x = 0; $x < count($veggies); $x++) {
    echo $veggies[$x];
    echo "<br>";
};
?>