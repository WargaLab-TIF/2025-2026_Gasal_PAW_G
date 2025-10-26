<?php
require_once 'validate.inc';
$errors = [];
$values = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $values['surname'] = $_POST['surname'] ?? '';
    $values['email'] = $_POST['email'] ?? '';
    $values['age'] = $_POST['age'] ?? '';

    validateName($values, 'surname', $errors);
    validateEmail($values, 'email', $errors);
    validateAge($values, 'age', $errors);

    if (empty($errors)) {
        echo "<h3>Form submitted successfully with no errors</h3>";
        echo "<p>Surname: " . htmlspecialchars($values['surname'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>Email: " . htmlspecialchars($values['email'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>Age: " . htmlspecialchars($values['age'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo '<p><a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">Back to empty form</a></p>';
        exit;
    }
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Form</title></head><body>
<?php include 'form.inc'; ?>
</body></html>
