<?php

$error = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['firstname'] = trim($_POST['firstname'] ?? '');
    $data['surname']   = trim($_POST['surname'] ?? '');
    $data['email']     = trim($_POST['email'] ?? '');
    $data['age']       = trim($_POST['age'] ?? '');
    $data['day']       = trim($_POST['day'] ?? '');
    $data['month']     = trim($_POST['month'] ?? '');
    $data['year']      = trim($_POST['year'] ?? '');

    if ($data['firstname'] == '')
        $error['firstname'] = 'Firstname wajib diisi';
    elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $data['firstname']))
        $error['firstname'] = 'Firstname hanya boleh huruf';

    if ($data['surname'] == '')
        $error['surname'] = 'Surname wajib diisi';
    elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $data['surname']))
        $error['surname'] = 'Surname hanya boleh huruf';

    if ($data['email'] == '')
        $error['email'] = 'Email wajib diisi';
    elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $error['email'] = 'Format email tidak valid';

    if ($data['age'] != '' && !is_numeric($data['age']))
        $error['age'] = 'Umur harus berupa angka';

    if ($data['day'] || $data['month'] || $data['year']) {
        if (!checkdate((int)$data['month'], (int)$data['day'], (int)$data['year'])) {
            $error['dob'] = 'Tanggal lahir tidak valid';
        }
    }

    $data['firstname'] = strtoupper($data['firstname']);
    $data['surname'] = strtoupper($data['surname']);

    if (!$error) {
        echo "<h3>Data berhasil dikirim!</h3>";
        echo "Firstname: " . htmlspecialchars($data['firstname']) . "<br>";
        echo "Surname: " . htmlspecialchars($data['surname']) . "<br>";
        echo "Email: " . htmlspecialchars($data['email']) . "<br>";
        if ($data['age'] != '') echo "Umur: " . htmlspecialchars($data['age']) . "<br>";
        if ($data['day'] && $data['month'] && $data['year'])
            echo "Tanggal Lahir: {$data['day']}-{$data['month']}-{$data['year']}<br>";
        echo "<br>";

        echo "<h3>Eksplorasi Fungsi Validasi Server-side (berdasarkan input Anda)</h3>";

        echo "<b>1. Regular Expression (preg_match)</b><br>";
        if (preg_match("/^[A-Z\s'-]+$/", $data['firstname']))
            echo "Firstname <b>{$data['firstname']}</b> valid (hanya huruf).<br>";
        else
            echo "Firstname <b>{$data['firstname']}</b> tidak valid (mengandung karakter lain).<br><br>";

        echo "<b>2. String Functions (trim, strtolower, strtoupper)</b><br>";
        $lower = strtolower($data['firstname']);
        $upper = strtoupper($data['firstname']);
        echo "Asli: {$data['firstname']}<br>";
        echo "Lowercase: $lower<br>";
        echo "Uppercase: $upper<br><br>";

        echo "<b>3. Filter Functions</b><br>";
        echo "Email: {$data['email']} → " . 
            (filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? "valid" : "tidak valid") . "<br>";
        echo "Umur: {$data['age']} → " . 
            (filter_var($data['age'], FILTER_VALIDATE_FLOAT) ? "angka valid" : "bukan angka") . "<br>";
        echo "Alamat IP (contoh): 192.168.0.1 → " . 
            (filter_var('192.168.0.1', FILTER_VALIDATE_IP) ? "valid" : "tidak valid") . "<br><br>";

        echo "<b>4. Type Testing</b><br>";
        echo "is_string(Firstname): " . (is_string($data['firstname']) ? "true" : "false") . "<br>";
        echo "is_numeric(Age): " . (is_numeric($data['age']) ? "true" : "false") . "<br>";
        echo "is_int(Age): " . (is_int($data['age']) ? "true" : "false") . "<br>";
        echo "is_float(Age): " . (is_float($data['age']) ? "true" : "false") . "<br><br>";

        echo "<b>5. Date Validation (checkdate)</b><br>";
        if ($data['day'] && $data['month'] && $data['year']) {
            if (checkdate((int)$data['month'], (int)$data['day'], (int)$data['year'])) {
                echo "Tanggal {$data['day']}-{$data['month']}-{$data['year']} valid.<br>";
            } else {
                echo "Tanggal {$data['day']}-{$data['month']}-{$data['year']} tidak valid.<br>";
            }
        } else {
            echo "Tanggal belum diisi lengkap.<br>";
        }

        echo "<hr>";
        $data = [];
    } else {
        echo "Periksa kembali input kamu.<br><br>";
    }
}

// tampilkan form
include 'form_full.inc';
?>
