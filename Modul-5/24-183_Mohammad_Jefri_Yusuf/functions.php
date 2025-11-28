<?php 

// Validasi Form

function validateName(&$errors, $field){
	if (empty($field)){
		$errors["nama"] = "Tidak Boleh Kosong";
        return false;
	} elseif (!preg_match("/^[a-zA-Z\s.]+$/",$field)){
		$errors["nama"] = "Hanya Boleh Huruf";
        return false;
	}
    return true;
}

function validatePhone(&$errors, $field){
	if (empty($field)){
		$errors["telp"] = "Tidak Boleh Kosong";
        return false;
	} elseif (!preg_match("/^[0-9]+$/",$field)){
		$errors["telp"] = "Hanya Boleh Angka";
        return false;
	}
    return true;
}

function validateAddress(&$errors, $field){
	if (empty($field)){
		$errors["alamat"] = "Tidak Boleh Kosong";
        return false;
	} elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9\s.,'-]+$/",$field)){
		$errors["alamat"] = "Isian Harus Alfanumerik (minimal harus ada 1 angka dan 1 huruf)";
        return false;
	}
    return true;
}

// Fungsi Button

function add($conn, $data)
{
    $nama = htmlspecialchars($data["nama"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO supplier VALUES('','$nama', '$telp', '$alamat')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};

function update($conn, $data, $id)
{   
    $nama = htmlspecialchars($data["nama"]);
    $telp = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE supplier SET
            nama = '$nama',
            telp = '$telp',
            alamat = '$alamat'
            WHERE id = $id
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};

function delete($conn, $id){

    mysqli_query($conn, "DELETE FROM supplier WHERE id = $id");
    return mysqli_affected_rows($conn);
}

?>