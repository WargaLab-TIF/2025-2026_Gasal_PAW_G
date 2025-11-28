<?php
$student = array(
    array("Alex","220401","0812345678"),
    array("Bianca","220402","0812345687"),
    array("Candice","220403","0812345665"),
    array("Asep","220404","0812435665"),
    array("Jordan","220405","0812345675"),
    array("Budi","220406","0812345895"),
    array("Ucup","220407","0832147965"),
    array("Tegar","220408","0823365621"),
);

for($row = 0;$row < 3;$row++){
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    for($col = 0;$col < 3;$col++){
        echo "<li>".$student[$row][$col]."</li>";
    }
    echo "</ul>";
}

echo "<hr>";

echo "<table border='1'>";
echo "<tr>";
echo "<th> Nama </th>";
echo "<th> Nim </th>";
echo "<th> No.hp </th>";
echo "</tr>";
for ($row = 0; $row < count($student); $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>" . $student[$row][$col] . "</td>";
    }
    echo "</tr>";
}
echo "</table>"
?>