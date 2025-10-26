<?php
require 'validate.inc';
$errors=[];$surname=$email=$age='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $surname=isset($_POST['surname'])?trim($_POST['surname']):'';
    $email=isset($_POST['email'])?trim($_POST['email']):'';
    $age=isset($_POST['age'])?trim($_POST['age']):'';
    if(!validateName(['surname'=>$surname],'surname')) $errors['surname']="Nama hanya huruf, apostrof atau tanda hubung.";
    if($email===''||!filter_var($email,FILTER_VALIDATE_EMAIL)) $errors['email']="Email tidak valid.";
    if($age===''||!ctype_digit($age)||(int)$age<=0) $errors['age']="Umur harus angka bulat positif.";
    if(!empty($errors)){
        echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Error</title></head><body>";
        echo "<h2 style='color:red;'>Terdapat error, perbaiki lalu submit kembali.</h2>";
        include 'form.inc';
        echo "</body></html>";
        exit;
    } else {
        echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Success</title></head><body>";
        echo "<h2 style='color:green;'>Form submitted successfully with no errors.</h2>";
        echo "<ul><li>Surname: ".htmlspecialchars($surname)."</li><li>Email: ".htmlspecialchars($email)."</li><li>Age: ".htmlspecialchars($age)."</li></ul>";
        echo "</body></html>";
        exit;
    }
} else {
    echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Form</title></head><body>";
    include 'form.inc';
    echo "</body></html>";
    exit;
}
?>
