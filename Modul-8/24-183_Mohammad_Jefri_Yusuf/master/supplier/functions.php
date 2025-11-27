<?php 

// Validasi Input Supplier
function validateName(&$errors, $field){
	if (empty($field)){
		$errors["nama"] = "Nama supplier tidak Boleh Kosong";
	} elseif (!preg_match("/^[a-zA-Z\s.]+$/",$field)){
		$errors["nama"] = "Hanya Boleh Huruf";
	}
}

function validatePhone(&$errors, $field){
	if (empty($field)){
		$errors["telp"] = "Nomor telepon tidak Boleh Kosong";
	} elseif (!is_numeric($field)){
		$errors["telp"] = "Hanya Boleh Angka";
	}
}

function validateAddress(&$errors, $field){
	if (empty($field)){
		$errors["alamat"] = "Alamat supplier tidak Boleh Kosong";
	} elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9\s.,'-]+$/",$field)){
		$errors["alamat"] = "Isian Harus Alfanumerik (minimal harus ada 1 angka dan 1 huruf)";
	}
}

// Fungsi Database Supplier
function insertSupplier($conn, $data){
    $nama = htmlspecialchars($data["nama"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $sql = "INSERT INTO supplier VALUES (NULL, ?, ?, ?)";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'sss', $nama, $telp, $alamat);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

function updateSupplier($conn, $data){
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $sql = "UPDATE supplier
            SET nama = ?, telp = ?, alamat = ?
            WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'sssi', $nama, $telp, $alamat, $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

function deleteSupplier($conn, $id){

    $sql_cek = "SELECT * FROM barang WHERE supplier_id = ?";
    $prepare_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($prepare_cek, 'i', $id);
    mysqli_stmt_execute($prepare_cek);
    mysqli_stmt_store_result($prepare_cek);

    if(mysqli_stmt_num_rows($prepare_cek) > 0) {
		return -1;
	} 

    $sql = "DELETE FROM supplier WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'i', $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
?>