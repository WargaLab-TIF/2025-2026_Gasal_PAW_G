<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function sum($x, $y) {
            $z = $x + $y;
            echo "$x + $y = $z <br>";
        }
        sum( 5,10);
        sum(7,13);
        sum(2,4);
    ?>
</body>
</html>