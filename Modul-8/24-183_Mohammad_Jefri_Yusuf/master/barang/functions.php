<?php 

// Validasi input Barang
function validateKodeBarang($conn, &$errors, $field){
    if(empty($field)){
        $errors["kode_barang"] = "Kode barang tidak boleh kosong";
    } else if(strlen($field) < 3 || strlen($field) > 10){
        $errors["kode_barang"] = "Kode barang harus antara 3-10 karakter";
    } else {
        $sql = "SELECT id FROM barang WHERE kode_barang = ?";
        $prepare = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($prepare, 's', $field);
        mysqli_stmt_execute($prepare);
        
        if(mysqli_stmt_num_rows($prepare) > 0){
            $errors["kode_barang"] = "Kode barang sudah digunakan";
        }
    }
}
function validateNamaBarang(&$errors, $field){
    if(empty($field)){
        $errors["nama_barang"] = "Nama barang tidak boleh kosong";
    }
}

function validateHarga(&$errors, $field){
    if(empty($field)){
        $errors["harga"] = "Harga barang tidak boleh kosong";
    } else if(!is_numeric($field) || $field <= 0){
        $errors["harga"] = "Harga harus berupa angka positif";
    }
}
function validateStok(&$errors, $field){
    if(empty($field)){
        $errors["stok"] = "Stok barang tidak boleh kosong";
    } else if(!is_numeric($field) || $field <= 0){
        $errors["stok"] = "Stok harus berupa angka positif";
    }
}
function validateSupplierId(&$errors, $field){
    if(empty($field)){
        $errors["supplier_id"] = "Supplier harus dipilih";
    }
}

// Fungsi Database Barang
function insertBarang($conn, $data){
    $kode_barang = htmlspecialchars($data["kode_barang"]);
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $harga = (int) htmlspecialchars($data["harga"]);
    $stok = (int) htmlspecialchars($data["stok"]);
    $supplier_id = htmlspecialchars($data["supplier_id"]);

    $sql = "INSERT INTO barang VALUES (NULL, ?, ?, ?, ?, ?)";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ssiii', $kode_barang, $nama_barang, $harga, $stok, $supplier_id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
function updateBarang($conn, $data){
    $id = $data["id"];
    $kode_barang = htmlspecialchars($data["kode_barang"]);
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $harga = (int) htmlspecialchars($data["harga"]);
    $stok = (int) htmlspecialchars($data["stok"]);
    $supplier_id = htmlspecialchars($data["supplier_id"]);

    $sql = "UPDATE barang
            SET kode_barang = ?, nama_barang = ?, harga = ?, stok = ?, supplier_id = ?
            WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ssiiii', $kode_barang, $nama_barang, $harga, $stok, $supplier_id, $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

function deleteBarang($conn, $id){
    $sql_cek = "SELECT * FROM transaksi_detail WHERE barang_id = ?";
    $prepare_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($prepare_cek, 'i', $id);
    mysqli_stmt_execute($prepare_cek);
    mysqli_stmt_store_result($prepare_cek);

    if(mysqli_stmt_num_rows($prepare_cek) > 0) {
        return -1;
    }

    $sql = "DELETE FROM barang WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'i', $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
?>