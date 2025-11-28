<?php 
 
require "validate.inc"; 
 
if (isset($_POST["submit"])){ 
    $errors = []; 
    $surname = $_POST["surname"]; 

    if(validateName($_POST,$errors ,"surname")){ 
        echo "data ok"; 
    }else{ 
        echo "data invalid"; 
    } 
}; 
 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <title>form modul 4</title> 
</head> 
<body> 
    <form action="processData.php" method="post"> 
        <label for="surname">masukkan nama : </label> 
        <input type="text" name="surname" value="<?php echo $surname ?? "" ?>"> 
        <span><?php echo $errors["surname"] ?? "" ?></span> 
        <br> <br> 
        <input type="submit" name="submit"> 
    </form> 
</body> 
</html> 