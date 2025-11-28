<?php
$student = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);
for($row = 0; $row < 3; $row++) {
    echo "<p><b>Row number $row</p></b>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++){
        echo "<li>".$student[$row][$col]."</li>";

    }
    echo "</ul>";
}
echo "<hr>";

// Menambahkan 5 data baru ===== 3.5.1 ======
array_push($student, array("Dewi", "220404", "0812345678"));
array_push($student, array("Eka", "220405", "0812345678"));
array_push($student, array("Fani", "220406", "0812345678"));
array_push($student, array("Gina", "220407", "0812345678"));
array_push($student, array("Hani", "220408", "0812345678"));
for($row = 0; $row < count($student); $row++) {
    echo "<p><b>Row number $row</p></b>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++){
        echo "<li>".$student[$row][$col]."</li>";
    }
    echo "</ul>";
}
echo "<hr>";
?>

<!-- Tabel ====== 3.5.2 ===== -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
        <?php
        for($row = 0; $row < count($student); $row++) {
            echo "<tr>";
            for ($col = 0; $col < 3; $col++){
                echo "<td>".$student[$row][$col]."</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>