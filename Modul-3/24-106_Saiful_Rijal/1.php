<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";

// menambahkan 5 array ====== 3.1.1 ======
array_push($fruits, "Durian");
array_push($fruits, "Eggplant");
array_push($fruits, "Fig");
array_push($fruits, "Grape");
array_push($fruits, "Honeydew");
echo "<br>";
echo "Index tertinggi dari fruits: " . count($fruits) - 1 . " adalah " . $fruits[count($fruits) - 1];

// menghapus array  ====== 3.1.2 ======
echo "<br>";
unset($fruits[7]);
echo "Index tertinggi dari fruits: " . count($fruits) - 1 . " adalah " . $fruits[count($fruits) - 1];

// membuar array baru ====== 3.1.3 ======
$veggies = array("Asparagus", "Broccoli", "Cabbage");
foreach ($veggies as $veggie) {
    echo "<br>";
    echo $veggie;
}
?>