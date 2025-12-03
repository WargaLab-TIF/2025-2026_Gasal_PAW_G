<?php 
// Validate input User

function validateUsername($conn, &$errors, $field) {
    if (empty($field)) {
        $errors['username'] = "Username tidak boleh kosong.";
    } else {
        // Cek apakah username sudah ada di database
        $query = "SELECT id_user FROM user WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $field);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['username'] = "Username sudah digunakan.";
        }
    }
}

function validatePassword(&$errors, $field) {
    if (empty($field)) {
        $errors['password'] = "Password tidak boleh kosong.";
    }
}

function validateNama(&$errors, $field) {
    if (empty($field)) {
        $errors['nama'] = "Nama tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z\s.]+$/",$field)){
        $errors["nama"] = "Hanya Boleh Huruf";
    }
}

function validatePhone(&$errors, $field) {
    if (empty($field)) {
        $errors['hp'] = "Nomor telepon tidak boleh kosong.";
    } elseif (!is_numeric($field)) {
        $errors['hp'] = "Hanya boleh angka";
    }
}

function validateAddress(&$errors, $field) {
    if (empty($field)) {
        $errors['alamat'] = "Alamat tidak boleh kosong.";
    }
}

function validateLevel(&$errors, $field) {
    if (empty($field)) {
        $errors['level'] = "Level user harus dipilih.";
    }
}

// Fungsi Database User
function insertUser($conn, $data){
    $username = htmlspecialchars($data["username"]);
    $password = md5(htmlspecialchars($data["password"]));
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $hp = htmlspecialchars($data["hp"]);
    $level = (int) htmlspecialchars($data["level"]);

    $sql = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'sssssi', $username, $password, $nama, $alamat, $hp, $level);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
function updateUser($conn, $data){
    $id = (int) $data["id"];
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $hp = htmlspecialchars($data["hp"]);
    $level = (int) htmlspecialchars($data["level"]);

    if ($data["password"] === '') {
        $sql = "UPDATE user
            SET username = ?, nama = ?, alamat = ?, hp = ?, level = ?
            WHERE id_user = ?";
        $prepare = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($prepare, 'ssssii', $username, $nama, $alamat, $hp, $level, $id);
        mysqli_stmt_execute($prepare);
    } else {
        $sql = "UPDATE user
                SET username = ?, password = ?, nama = ?, alamat = ?, hp = ?, level = ?
                WHERE id_user = ?";
        $prepare = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($prepare, 'sssssii', $username, md5($password), $nama, $alamat, $hp, $level, $id);
        mysqli_stmt_execute($prepare);
    }

    return mysqli_stmt_affected_rows($prepare);
}
function deleteUser($conn, $id){
    $sql = "DELETE FROM user WHERE id_user = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'i', $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
?>