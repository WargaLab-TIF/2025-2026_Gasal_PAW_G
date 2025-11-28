<!DOCTYPE html>
<html>
<head>
    <title>Fungsi sum0</title>
</head>
<body>
    <?php
    function sum0($x, $y) {
        $z = $x + $y;
        echo "$x + $y = $z";
    }

    sum0(5, 10);
    echo "<br>";
    sum0(7, 13);
    echo "<br>";
    sum0(2, 4);
    ?>
</body>
</html>