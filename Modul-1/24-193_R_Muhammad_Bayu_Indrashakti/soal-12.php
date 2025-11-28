<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $kata = "Hello world!";
    $katacari = "world";
    $kataganti = "Dolly";
    $hasil = str_replace($katacari, $kataganti, $kata);
    echo ($hasil);
    ?>
</body>
</html>