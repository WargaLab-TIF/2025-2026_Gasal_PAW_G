<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);


array_push($students,
    array("ardi", "220450", "082335897111"),
    array("sulhan", "220458", "087967297091"),
    array("agus", "220466", "081237287861"),
    array("qomar", "220428", "081234572912"),
    array("cello", "220477", "089301234594")
);


echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr><th>Nama</th><th>NIM</th><th>No. HP</th></tr>";

foreach ($students as $row) {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>"; 
    echo "<td>" . $row[1] . "</td>"; 
    echo "<td>" . $row[2] . "</td>"; 
    echo "</tr>";
}

echo "</table>";
?>