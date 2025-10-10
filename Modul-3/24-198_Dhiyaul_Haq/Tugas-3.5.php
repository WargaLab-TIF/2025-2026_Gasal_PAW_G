<?php
    // Implementasi skrip
    $students = array(
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665"),
    );
    for($row = 0; $row < 3; $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        for($col = 0; $col < 3; $col++) {
            echo "<li>".$students[$row][$col]."</li>";
        }
        echo "</ul>";
    }

    // 3.5.1 (Tambahkan 5 data baru)
    array_push($students, ["Beatrice", "220404", "08123123"], ["Bernie", "220405", "08123234"], ["Roland", "220406", "08123412"], ["Stanford", "22040623", "0812324324"], ["Knitz", "220424", "081232312"]);

    // 3.5.2 (Tampilkan dalam bentuk tabel)
    echo "<hr>";
    echo "<table border=1 style='border-collapse: collapse;'>";
    echo "<tr>";
    echo "<td><b>Name</b></td>";
    echo "<td><b>NIM</b></td>";
    echo "<td><b>Mobile</b></td>";
    echo "</tr>";
    foreach($students as $stu) {
        echo "<tr>";
        echo "<td width= 100px>".$stu[0]."</td>";
        echo "<td width= 100px>".$stu[1]."</td>";
        echo "<td width= 100px>".$stu[2]."</td>";
        echo "</tr>";
    }
    echo "</table>"; 
?>
