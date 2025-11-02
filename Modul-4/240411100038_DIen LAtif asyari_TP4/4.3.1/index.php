<?php  

require 'validate.inc.php';



    $list_name = [];
    $surname = "";

if (validateName($_POST, "surname")) {
        header("Location: dashboard.php");
        ;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Modul 4</title>
</head>
<body>
    <form action="prosesData.php" method="POST">
        
        <label for="surname">Masukkan Nama</label>
        <input type="text" name="surname" value="<?= $surname ?? "" ?>">
        <span><?= $list_name['surname'] ?? "" ?></span>
        <br>

        <input type="submit" name="submit">
    </form>
</body>
</html>