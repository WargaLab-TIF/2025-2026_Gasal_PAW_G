<?php 

require 'validate.inc';

$errors = [];

if (validateName($errors, $_POST, "surname")) {
    echo "Data OK!";
} else {
    echo "Data Invalid!";
    foreach ($errors as $field => $error_message) {
        echo "<span> $error_message</span>";
    }
}


?>