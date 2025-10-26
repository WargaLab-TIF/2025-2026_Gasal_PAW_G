<?php
require 'validate.inc';

$errors = [];

if (validateName($_POST, 'username')) {
    echo 'Data OK!';
} else {
    if (isset($errors['username'])) {
        echo $errors['username'];
    } else {
        echo 'Data invalid!';
    }
}
?>
