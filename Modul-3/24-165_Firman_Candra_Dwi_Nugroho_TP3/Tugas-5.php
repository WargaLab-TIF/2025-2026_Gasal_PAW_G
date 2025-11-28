<?php
//===========================//
//        3.5.1              //
//===========================//
echo "3.5.1 <br>";
echo "<br>";

$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345655")
);

array_push($students, array("David", "220404", "0812345000"));
array_push($students, array("Eva", "220405", "0812345111"));
array_push($students, array("Fikri", "220406", "0812345222"));
array_push($students, array("Gina", "220407", "0812345333"));
array_push($students, array("Hana", "220408", "0812345444"));

for ($row = 0; $row < count($students); $row++) {
    echo "Row number $row: ";
    for ($col = 0; $col < 3; $col++) {
        echo $students[$row][$col] . " ";
    }
    echo "<br>";
}

echo "<br><br>";

//===========================//
//        3.5.2              //
//===========================//
echo "3.5.2 <br>";
echo "<br>";

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

for ($row = 0; $row < count($students); $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $students[$row][$col] . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>
