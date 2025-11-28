<?php 

//===========//
//  3.3.1    //
//===========//
echo "3.3.1 <br>";
echo "<br>";

$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Eva"] = "160";
$height["Fikri"] = "175";
$height["Gina"] = "168";
$height["Hana"] = "162";

$lastValue = end($height);
$lastKey = key($height);

echo "Indeks terakhir: $lastKey => $lastValue cm";

echo "<br>";
echo "<br>";
echo "<br>";


//==========//
//  3.3.2   //
//==========//
echo "3.3.2 <br>";
echo "<br>";

$height = array(
    "Andy"=>"176", 
    "Barry"=>"165", 
    "Charlie"=>"170",
    "David"=>"180",
    "Eva"=>"160",
    "Fikri"=>"175",
    "Gina"=>"168",
    "Hana"=>"162"
);

unset($height["Hana"]);

$lastValue = end($height);
$lastKey = key($height);

echo "Setelah hapus Hana, data terakhir: $lastKey => $lastValue cm";

echo"<br>";
echo "<br>";
echo "<br>";


//==========//
//   3.3.3  //
//==========//
echo "3.3.3<br>";
echo "<br>";


$weight = array("Andy"=>65, "Barry"=>58, "Charlie"=>60);

$values = array_values($weight);
$keys = array_keys($weight);

echo "Data ke-2: " . $keys[1] . " => " . $values[1] . " kg";

?>
