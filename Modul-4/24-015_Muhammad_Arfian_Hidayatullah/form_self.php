<?php
require 'validate.inc';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validName = validateName($_POST, 'surname');
    $validEmail = validateEmail($_POST, 'email');

    if ($validName && $validEmail) {
        echo "Form submitted successfully with no errors.<br><br>";
    } else {
        global $errors;
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo "<br>";
        include 'form.inc';
    }

} else {
    include 'form.inc';
}
?>
