<?php
require 'validate.inc';
$errors = [];

if (validateName($_POST, 'surname', $errors)) {
    $surname = htmlspecialchars(trim($_POST['surname']), ENT_QUOTES, 'UTF-8');
    echo "<h3>Data OK!</h3>";
    echo "<p>Nama yang dimasukkan: <strong>" . $surname . "</strong></p>";
} else {
    echo "<h3>Data invalid!</h3>";
    foreach ($errors as $field => $msg) {
        echo "<p><strong>" . htmlspecialchars($field, ENT_QUOTES, 'UTF-8') . ":</strong> " . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . "</p>";
    }
}
?>
