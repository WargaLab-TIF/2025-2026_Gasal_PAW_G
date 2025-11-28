<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $text = "Hello world!";

    $jumlah_kata = str_word_count($text);
    echo "$jumlah_kata";
    ?>
</body>
</html>