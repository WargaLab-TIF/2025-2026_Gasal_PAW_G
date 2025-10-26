<?php
require_once 'validate.inc';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (validateName($_POST, 'surname')) {
        echo 'Data OK!<br>';
    } else {
        echo 'Data invalid!<br>';
    }
    
    echo '<br>--- Step 4-6: With Error Details ---<br><br>';
    
    if (validateNameWithErrors($_POST, 'surname', $errors)) {
        echo 'Data OK!<br>';
    } else {
        echo 'Data invalid!<br>';
        echo 'Error details:<br>';
        if (isset($errors['surname'])) {
            echo '- ' . $errors['surname'] . '<br>';
        }
    }
    
    echo '<br><br>Form Data:<br>';
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
} else {
    echo 'Please submit the form first.';
}
