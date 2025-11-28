<?php
function familyNameWithYear($fname, $year) {
    echo $fname . " born in " . $year . "<br>";
}

// Memanggil function 3 kali dengan nilai berbeda
familyNameWithYear("Hege", 1975);
familyNameWithYear("Stale", 1978);
familyNameWithYear("Kai Jim", 1983);
?>