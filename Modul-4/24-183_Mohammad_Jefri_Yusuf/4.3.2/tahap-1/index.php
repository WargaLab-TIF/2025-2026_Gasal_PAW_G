<?php 

require 'validate.inc';


if (isset($_POST['submit'])) {
    $errors = [];

    if (validateName($errors, $_POST, "surname")) {
        echo "Data OK!";
    } else {
        echo "Data Invalid!";
        foreach ($errors as $field => $error_message) {
            echo "<span> $error_message</span>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Praktikum 4.3.2</title>
</head>
<body>
    <form action="index.php" method="POST">
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>