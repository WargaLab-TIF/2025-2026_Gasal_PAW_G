<?php  

function validateSurname(&$errors, $field){
    // Gunakan trim() untuk menghapus spasi di awal/akhir
    $field = trim($field);
    
    if (empty($field)){
        $errors['surname'] = 'Surname Required';
    } elseif (!preg_match("/^[a-zA-Z'-]+$/",$field)){
        $errors['surname'] = 'Surname wajib nama';
    }
}

function validateEmail(&$errors, $field){
    // Gunakan trim() dan strtolower() untuk normalisasi
    $field = trim(strtolower($field));
    
    if (empty($field)){
        $errors['email'] = 'Email Required';
    } elseif (!filter_var($field, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Masukkan Email yang valid';
    }
}

function validateNomor(&$errors, $field){
    // Gunakan trim()
    $field = trim($field);
    
    // Validasi tipe data: pastikan input adalah string (untuk keamanan)
    if (!is_string($field)) {
        $errors['nomor'] = 'Nomor harus berupa teks';
        return;
    }
    
    if (!preg_match('/^0[0-9]+$/', $field)) {
        $errors['nomor'] = 'Masukkan numerik dan diawali dengan nol';
    } elseif (strlen($field) < 10 || strlen($field) > 13 ){
        $errors['nomor'] = 'Nomor memiliki 10 - 13 digit';
    }
}

function validateTanggalLahir(&$errors, $tanggal, $bulan, $tahun){
    // Konversi ke integer untuk memastikan tipe data benar
    $tanggal = (int)$tanggal;
    $bulan = (int)$bulan;
    $tahun = (int)$tahun;

    // Validasi apakah inputnya benar-benar angka dan tidak kosong
    if (empty($tanggal) || empty($bulan) || empty($tahun)) {
        $errors['tanggal_lahir'] = 'Tanggal lahir wajib diisi';
        return;
    }

    // Gunakan checkdate() untuk validasi tanggal
    if (!checkdate($bulan, $tanggal, $tahun)) {
        $errors['tanggal_lahir'] = 'Tanggal lahir tidak valid';
    }
}

?>
