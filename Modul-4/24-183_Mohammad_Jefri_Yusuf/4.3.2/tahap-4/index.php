<?php
require 'validate.inc'; 

if (isset($_POST['submit'])) {
    $errors = [];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    $isSurnameValid = validateName($errors, $_POST, 'surname');
    $isEmailValid = validateEmail($errors, $_POST, 'email');

    if ($isEmailValid && $isSurnameValid) {
        echo "Form submitted successfully with no errors";
    } else {
        require 'form.inc';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    require 'form.inc';
}
?>