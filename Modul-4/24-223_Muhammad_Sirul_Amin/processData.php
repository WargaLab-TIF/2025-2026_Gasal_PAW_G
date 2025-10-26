<?php
require 'validate.inc';

if (validateName($_POST, 'surname')) {
    echo "Data OK!";
} else {
    global $errors;
    foreach ($errors as $err) {
        echo $err . "<br>";
    }
}
?>