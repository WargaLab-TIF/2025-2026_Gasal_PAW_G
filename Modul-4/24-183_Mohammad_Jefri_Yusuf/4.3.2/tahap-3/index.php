<?php
require 'validate.inc'; 

if (isset($_POST['submit'])) {
    $errors = [];
    $surname = $_POST['surname'];

    if (empty($_POST['surname'])) {
        require 'form.inc';
    } elseif (validateName($errors, $_POST, 'surname')) {
        echo "Form submitted successfully with no errors";
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        require 'form.inc';
    }
} else {
    require 'form.inc';
}
?>