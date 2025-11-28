<?php 

$students = array(
    array("Alex","220401","0812345678"),
    array("Bianca","220402","0812345687"),
    array("Candice","220403","0812345665"),
    array("adi","220404","0812345666"),
    array("agus","220405","0812345667"),
    array("farhan","220406","0812345668"),
    array("dana","220407","0812345669"),
    array("dani","220408","0812345663")

);
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach($students as $std){
    echo "<tr>";
    echo "<td>". $std[0] . "</td>";
    echo "<td>". $std[1] . "</td>";
    echo "<td>". $std[2] . "</td>";
    echo "</tr>";
}
echo "</table>";