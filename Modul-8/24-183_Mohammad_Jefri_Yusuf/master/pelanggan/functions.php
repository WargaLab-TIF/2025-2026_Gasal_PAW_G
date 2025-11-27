<?php 

// Validasi input Pelanggan
function validateIDPelanggan($conn, &$errors, $field){
    if (empty($field)) {
        $errors['id'] = "ID Pelanggan tidak boleh kosong.";
    };
    $sql = "SELECT id FROM pelanggan WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 's', $field);
    mysqli_stmt_execute($prepare);
    mysqli_stmt_store_result($prepare);
    if(mysqli_stmt_num_rows($prepare) > 0){
        $errors["id"] = "ID Pelanggan sudah digunakan";
    }
}

function validateNamaPelanggan(&$errors, $field){
    if (empty($field)) {
        $errors['nama'] = "Nama Pelanggan tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z\s.]+$/",$field)){
        $errors["nama"] = "Hanya Boleh Huruf";
    }
}

function validateJenisKelamin(&$errors, $field){
    if (empty($field)) {
        $errors['jenis_kelamin'] = "Jenis Kelamin tidak boleh kosong.";
    }
}
function validatePhone(&$errors, $field){
    if (empty($field)) {
        $errors['telp'] = "Nomor telepon tidak boleh kosong.";
    } elseif (!is_numeric($field)){
        $errors["telp"] = "Hanya Boleh Angka";
    }
}
function validateAddress(&$errors, $field){
    if (empty($field)) {
        $errors['alamat'] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9\s.,'-]+$/",$field)){
        $errors["alamat"] = "Isian Harus Alfanumerik (minimal harus ada 1 angka dan 1 huruf)";
    }
}

// Fungsi Database Pelanggan
function insertPelanggan($conn, $data){
    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $sql = "INSERT INTO pelanggan VALUES (?, ?, ?, ?, ?)";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'sssss', $id, $nama, $jenis_kelamin, $telp, $alamat);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

function updatePelanggan($conn, $data){
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $sql = "UPDATE pelanggan
            SET nama = ?, jenis_kelamin = ?, telp = ?, alamat = ?
            WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'sssss', $nama, $jenis_kelamin, $telp, $alamat, $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

function deletePelanggan($conn, $id){

    $sql_cek = "SELECT * FROM transaksi WHERE pelanggan_id = ?";
    $prepare_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($prepare_cek, 's', $id);
    mysqli_stmt_execute($prepare_cek);
    mysqli_stmt_store_result($prepare_cek);
    if(mysqli_stmt_num_rows($prepare_cek) > 0){
        return -1;
    }
    $sql = "DELETE FROM pelanggan WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 's', $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
?>