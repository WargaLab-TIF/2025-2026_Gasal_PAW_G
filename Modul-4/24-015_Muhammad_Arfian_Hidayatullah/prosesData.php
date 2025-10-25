<?php
require 'validate.inc';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Silakan isi form terlebih dahulu.";
    exit;
}

$errors = [];

if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
} else {
    echo 'Data invalid!<br>';
    foreach ($errors as $err) {
        echo htmlspecialchars($err) . "<br>";
    }
}
?>

