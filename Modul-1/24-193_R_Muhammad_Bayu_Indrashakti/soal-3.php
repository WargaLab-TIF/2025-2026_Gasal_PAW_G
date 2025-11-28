<?php
// ini non embedded script
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "    <title>Hello World</title>";
echo "</head>";
echo "<body>";
echo "    <h1>Hello World</h1>";
echo "</body>";
echo "</html>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        <?php
        // ini embeded-script
        echo "Hello World";
        ?>
    </h1>
</body>
</html>