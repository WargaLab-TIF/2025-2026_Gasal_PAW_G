<?php
require 'validate.inc.php';

$errors = [];

if (validateName($_POST, 'surname', $errors)) {
    echo "Data OK!";
} else {
    echo "Data invalid!<br>";
    foreach ($errors as $err) {
        echo "<p style='color:red;'>$err</p>";
    }
}
?>
