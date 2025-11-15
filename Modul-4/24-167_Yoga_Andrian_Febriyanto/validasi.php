<?php
$errors = [];
$surname='';
$email='';
if (isset($_POST['submit'])) {
    $surname = trim($_POST['surname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $nomor = trim($_POST['nomor'] ?? '');

    if (empty($surname)) {
        $errors['surname'] = 'Surname Required';
    } elseif (!preg_match("/^[a-zA-Z'\-\s]+$/", $surname)) {
        $errors['surname'] = 'Surname hanya boleh berisi huruf';
    }
    if (empty($email)) {
        $errors['email'] = 'Email Required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Masukkan Email yang valid';
    }
    if (empty($nomor)) {
        $errors['nomor'] = 'Nomor Telepon Required';
    } elseif (!preg_match('/^0[0-9]+$/', $nomor)) {
        $errors['nomor'] = 'Nomor harus diawali 0 dan hanya berisi angka';
    } elseif (strlen($nomor) < 10 || strlen($nomor) > 13) {
        $errors['nomor'] = 'Nomor harus terdiri dari 10–13 digit';
    }
    if (count($errors)==0) {
        header('Location: dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validasi</title>
</head>
<body>
    <?php require 'form.inc'; ?>
</body>
</html>