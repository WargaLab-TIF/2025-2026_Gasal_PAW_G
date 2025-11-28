<?php
require 'validate.inc.php'; 

$errors = [];
$firstname = "";
$surname = "";
$email = "";
$age = "";
$phone = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $valid = true;

    if (!validateName($_POST, 'firstname', $errors)) $valid = false;
    if (!validateName($_POST, 'surname', $errors)) $valid = false;
    if (!validateEmail($_POST, 'email', $errors)) $valid = false;
    if (!validateAge($_POST, 'age', $errors)) $valid = false;
    if (!validatePhone($_POST, 'phone', $errors)) $valid = false;
    if (!validatePassword($_POST, 'password', $errors)) $valid = false;

    if ($valid) {
        echo "<p style='color:green;'> Semua data valid! Form berhasil dikirim.</p>";
    } else {
        echo "<p style='color:red;'> Terdapat kesalahan pada data:</p>";
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    }
}
?>

<h2>Form Validasi Lengkap</h2>
<form action="formValidateAll.php" method="post">
    First Name: <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>"><br><br>
    Surname: <input type="text" name="surname" value="<?php echo htmlspecialchars($surname); ?>"><br><br>
    Email: <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>
    Umur: <input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>
    Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>"><br><br>
    <input type="submit" value="Submit">
</form>
