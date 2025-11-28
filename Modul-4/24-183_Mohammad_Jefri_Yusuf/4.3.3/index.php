<?php
require 'validate.inc'; 

$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$website = $_POST['website'] ?? '';

if (isset($_POST['submit'])) {
    $errors = [];
    $data_bersih = [
        'surname' => $surname,
        'email' => $email,
        'age' => $age,
        'website' => $website
    ];

    $isSurnameValid = validateName($errors, $data_bersih, 'surname');
    $isEmailValid = validateEmail($errors, $data_bersih, 'email');
    $isAgeValid = validateAge($errors, $data_bersih, 'age');
    $isWebsiteValid = validateWebsite($errors, $data_bersih, 'website');

    if ($isEmailValid && $isSurnameValid && $isAgeValid && $isWebsiteValid) {
        echo "Form submitted successfully with no errors";
    } else {
        require 'form.inc';
        echo "<p>Errors:</p>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    require 'form.inc';
}
?>