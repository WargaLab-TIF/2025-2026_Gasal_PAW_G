<?php  
require 'fungsi.php';

if (isset($_POST['submit'])) {

    $errors = [];
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';
    $nomor = $_POST['nomor'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $bulan = $_POST['bulan'] ?? '';
    $tahun = $_POST['tahun'] ?? '';

    validateSurname($errors, $surname);
    validateEmail($errors, $email);
    validateNomor($errors, $nomor);
    validateTanggalLahir($errors, $tanggal, $bulan, $tahun);

    if (count($errors) == 0) {
        header('Location:dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Modul 4</title>
</head>
<body>
    <form action="index.php" method="POST">
        
        <label for="surname">Masukkan Nama</label>
        <input type="text" name="surname" value="<?= $surname ?? "" ?>">
        <span><?= $errors['surname'] ?? "" ?></span>
        <br>

        <label for="email">Masukkan Email</label>
        <input type="text" name="email" value="<?= $email ?? "" ?>">
        <span><?= $errors['email'] ?? "" ?></span>
        <br>
        <label for="nomor">Masukkan Nomor Telepon</label>
        <input type="text" name="nomor" value="<?= $nomor ?? "" ?>">
        <span><?= $errors['nomor'] ?? "" ?></span>
        <br>
        <label for="tanggal_lahir">Tanggal Lahir</label><br>
        <select name="tanggal">
            <option value="">Tanggal</option>
            <?php for ($i = 1; $i <= 31; $i++): ?>
                <option value="<?= $i ?>" <?= ($tanggal == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
        <select name="bulan">
            <option value="">Bulan</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= ($bulan == $i) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
            <?php endfor; ?>
        </select>
        <select name="tahun">
            <option value="">Tahun</option>
            <?php for ($i = 1900; $i <= 2025; $i++): ?>
                <option value="<?= $i ?>" <?= ($tahun == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
        <span><?= $errors['tanggal_lahir'] ?? "" ?></span>
        <br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

