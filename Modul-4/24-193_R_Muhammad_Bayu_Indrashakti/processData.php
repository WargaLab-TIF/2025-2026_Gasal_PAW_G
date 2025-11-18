<?php
require 'validate.inc';

$errors = [];
if (validateName($errors, $_POST, 'surname'))
{
    echo 'Data valid! <br>';
} 
else 
{
    echo 'Data tidak valid! <br>';
    foreach ($errors as $field => $error_message) {
        echo $field . ': ' . $error_message;
    }
}
?>