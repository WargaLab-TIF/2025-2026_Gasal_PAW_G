<?php
require 'prosesData.php';

$error = "";
$surname = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST["surname"] ?? "";
    $error = validateName($surname);

    if (empty($error)) {
        $success = "berhasil mengisi form makasih bro!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
</head>
<body>

<?php
 if (!empty($success)) {
        echo $success;
    }

    include 'form.php';
    ?>
</body>
</html>
