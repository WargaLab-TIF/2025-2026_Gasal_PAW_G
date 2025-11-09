<?php
require_once 'validate.inc';

$errors = array();
$form_data = array();
$submitted = false;
$isValid = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $submitted = true;
    
    $form_data = $_POST;
    
    if (validateAllFields($_POST, $errors)) {
        $isValid = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Validation - Self Submission</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; font-weight: bold; padding: 10px; margin: 10px 0; background-color: #d4edda; border: 1px solid #c3e6cb; }
        .error { color: red; padding: 5px; }
        table { border-collapse: collapse; margin: 20px 0; }
        td { padding: 5px; }
        input[type="text"] { padding: 5px; width: 200px; }
        input[type="submit"] { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Form Validation with Self-Submission</h2>
    
    <?php
    if ($submitted) {
        if ($isValid) {
            echo '<div class="success">Form submitted successfully with no errors!</div>';
        } else {
            echo '<div style="color: red; padding: 10px; margin: 10px 0; background-color: #f8d7da; border: 1px solid #f5c6cb;">
                    <strong>Form submission failed. Please correct the errors:</strong><br>';
            foreach ($errors as $error) {
                echo '- ' . $error . '<br>';
            }
            echo '</div>';
            
            include_once 'form.inc';
        }
    } else {
        include_once 'form.inc';
    }
    ?>
</body>
</html>

