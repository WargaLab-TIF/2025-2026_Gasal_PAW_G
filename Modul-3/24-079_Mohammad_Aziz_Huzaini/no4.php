<?php
// 3.4.1
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["Aziz"] = "168";
$height["Ucup"] = "145";
$height["Adi"] = "180";
$height["Wawan"] = "178";
$height["Firman"] = "175";

foreach($height as $x => $x_value){
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
echo "tidak perlu karena perulangan akan langsung menyesuaikan dengan isi array";

echo "<br> <br>";
// 3.4.2
$weight = array("Andy"=>"76", "Barry"=>"65", "Charlie"=>"70");
foreach($weight as $x => $x_value){
    echo "Key = " . $x . ", Value = " . $x_value;
    echo "<br>";
}
echo "hanya perlu memodifikasi variabelnya saja";
?>