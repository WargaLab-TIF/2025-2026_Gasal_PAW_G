<?php
$errors = [];
$data = [];
$successMessage = '';

function validateName($field_list, $field_name)
{
    global $errors;

    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = 'Field tidak ditemukan.';
        return false;
    }

    $value = trim($field_list[$field_name]);

    if ($value === '') {
        $errors[$field_name] = 'Nama tidak boleh kosong.';
        return false;
    }

    $pattern = "/^[a-zA-Z\s'-]+$/";

    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = 'Nama hanya boleh berisi huruf, spasi, tanda hubung, atau apostrof.';
        return false;
    }

    return true;
}

function validateEmail($field_list, $field_name, &$errors)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Email wajib diisi.";
        return false;
    } elseif (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Format email tidak valid.";
        return false;
    }
    return true;
}

function validatePassword($field_list, $field_name, &$errors)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Password wajib diisi.";
        return false;
    } elseif (strlen($field_list[$field_name]) < 6) {
        $errors[$field_name] = "Password minimal 6 karakter.";
        return false;
    }
    return true;
}

function validateAddress($field_list, $field_name, &$errors)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Alamat wajib diisi.";
        return false;
    }
    return true;
}

function validateState($field_list, $field_name, &$errors)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Semester wajib dipilih.";
        return false;
    }
    return true;
}

function validateGender($field_list, $field_name, &$errors)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Pilih jenis kelamin.";
        return false;
    }
    return true;
}

function validateHobi($field_list, $field_name, &$errors)
{
    if (empty($field_list[$field_name])) {
        $errors[$field_name] = "Pilih minimal satu hobi.";
        return false;
    }
    return true;
}

// Fungsi validasi umur → Type testing
function validateAge($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field '$field_name' harus diisi.";
        return false;
    }

    $age = $field_list[$field_name];

    // pastikan umur numeric (type testing)
    if (!is_numeric($age)) {
        $errors[$field_name] = "Umur harus berupa angka.";
        return false;
    }

    // ubah ke integer
    $age = (int)$age;

    if ($age < 0 || $age > 120) {
        $errors[$field_name] = "Umur tidak valid.";
        return false;
    }

    return true;
}

// Fungsi validasi tanggal lahir → Date (checkdate)
function validateBirthdate($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = "Field '$field_name' harus diisi.";
        return false;
    }

    $birthdate = $field_list[$field_name];

    // pisahkan tanggal menjadi tahun, bulan, hari
    $parts = explode('-', $birthdate);
    if (count($parts) !== 3) {
        $errors[$field_name] = "Tanggal lahir harus format YYYY-MM-DD.";
        return false;
    }

    [$year, $month, $day] = $parts;

    // validasi tanggal menggunakan checkdate (Date)
    if (!checkdate((int)$month, (int)$day, (int)$year)) {
        $errors[$field_name] = "Tanggal lahir tidak valid.";
        return false;
    }

    return true;
}



// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    validateName($data, 'username', $errors);
    validateEmail($data, 'email', $errors);
    validatePassword($data, 'password', $errors);
    validateAddress($data, 'address', $errors);
    validateState($data, 'state', $errors);
    validateGender($data, 'gender', $errors);
    validateHobi($data, 'hobi', $errors);
    validateAge($data, 'age', $errors);
    validateBirthdate($data, 'birthdate', $errors);

    if (empty($errors)) {
        $successMessage = "Data berhasil di masukan";
    }
}
?>

