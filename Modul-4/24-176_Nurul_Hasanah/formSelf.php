<?php
require 'validate.inc.php'; 

$errors = [];   
$surname = "";  


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST['surname']; 

    if (validateName($_POST, 'surname', $errors)) {
        echo "<p style='color:green;'>Form submitted successfully with no errors!</p>";
    } else {
        echo "<p style='color:red;'>Terjadi error!</p>";
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    }
}
?>

<h2>Self Submission Form</h2>
<form action="formSelf.php" method="post">
    Surname: <input type="text" name="surname" value="<?php echo htmlspecialchars($surname); ?>">
    <input type="submit" value="Submit">
</form>
