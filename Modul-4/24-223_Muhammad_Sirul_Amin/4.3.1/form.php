<?php
require 'validate.inc';
$success = false;

// untuk cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validName  = validateName($_POST, 'surname');
    $validEmail = validateEmail($_POST, 'email');
    $validAge   = validateAge($_POST, 'age');

    if ($validName && $validEmail && $validAge) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Validation</title>
</head>
<body>
<?php if ($success): ?>
    <!-- sukes -->
    <h2 style="color:green;">Form sukses dikirim !</h2>
    <p>Terima kasih, data kamu sudah masuk.</p>
    <a href="form.php">Kembali ke Form</a>

<?php else: ?>
    <h2>paw</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<ul style='color:red;'>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul>";
    }
    ?>

    <form method="post" action="form.php">
        <label>Surname:</label>
        <input type="text" name="surname" 
               value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
        <br><br>

        <label>Email:</label>
        <input type="text" name="email" 
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <br><br>

        <label>umut:</label>
        <input type="text" name="age" 
               value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>">
        <br><br>

        <input type="submit" value="Submit">
    </form>
<?php endif; ?>
</body>
</html>