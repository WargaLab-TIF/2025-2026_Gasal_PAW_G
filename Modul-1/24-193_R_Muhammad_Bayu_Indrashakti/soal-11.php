<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $string = "Hello world!";
        $kata = "world";
        $posisi = strpos($string, $kata);
        echo $posisi !== false ? ($posisi) :"";
    ?>
</body>
</html>