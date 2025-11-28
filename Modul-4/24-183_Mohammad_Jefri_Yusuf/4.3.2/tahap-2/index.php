<?php
require 'validate.inc'; 

if (isset($_POST['submit'])) {
    $errors = [];
    if (empty($_POST['surname'])) {
        require 'form.inc';
    } elseif (validateName($errors, $_POST, 'surname')) {
        echo "Form submitted successfully with no errors";
    } else {
        foreach ($errors as $field => $error) {
            echo "<p>$field: $error</p>";
        }
        require 'form.inc';
    }
} else {
    require 'form.inc';
}
?>