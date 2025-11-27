<?php 

// Validasi input Transaksi
function validateWaktuTransaksi(&$errors, $field) {
    if (empty($field)) {
        $errors['waktu_transaksi'] = "Waktu transaksi tidak boleh kosong.";
    } elseif($field < date('Y-m-d')) {
        $errors["waktu_transaksi"] = "Tanggal tidak boleh kurang dari tanggal hari ini";
    }
}

function validateKeterangan(&$errors, $field) {
    if (empty($field)) {
        $errors['keterangan'] = "Keterangan tidak boleh kosong.";
    } elseif (strlen($field) < 3) {
        $errors['keterangan'] = "Panjang minimal 3 karakter";
    }
}

function validatePelangganID(&$errors, $field) {
    if (empty($field)) {
        $errors['pelanggan_id'] = "Pelanggan harus dipilih";
    }
}

// Validasi input Transaksi Detail

function validateBarangID($conn, &$errors, $barangID, $transaksiID){
    if(empty($barangID)){
        $errors["barang_id"] = "Barang tidak boleh kosong";
        return;
    }
    if(!empty($transaksiID)){
        $listBarang = getData($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id = $transaksiID AND barang_id = $barangID");
        if (count($listBarang) > 0 ){
            $errors["barang_id"] = "Barang ini sudah ditambahkan ke dalam detail transaksi";
        }
    }
    
}

function validateTransaksiID(&$errors, $field){
    if(empty($field)){
        $errors["transaksi_id"] = "ID Transaksi tidak boleh kosong";
    }
}

function validateQty(&$errors, $field){
    if(empty($field)){
        $errors["qty"] = "Quantity tidak boleh kosong";
    } elseif(!is_numeric($field) || $field <= 0){
        $errors["qty"] = "Quantity harus berupa angka positif";
    }
}

// Fungsi Database Transaksi
function insertTransaksi($conn, $data){
    $waktu_transaksi = htmlspecialchars($data["waktu_transaksi"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $total = (int) htmlspecialchars($data["total"]);
    $pelanggan_id = htmlspecialchars($data["pelanggan_id"]);

    $sql = "INSERT INTO transaksi VALUES (NULL, ?, ?, ?, ?)";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ssis', $waktu_transaksi, $keterangan, $total, $pelanggan_id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}
function updateTransaksi($conn, $data){
    $id = $data["id"];
    $waktu_transaksi = htmlspecialchars($data["waktu_transaksi"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $total = (int) htmlspecialchars($data["total"]);
    $pelanggan_id = htmlspecialchars($data["pelanggan_id"]);
    $sql = "UPDATE transaksi
            SET waktu_transaksi = ?, keterangan = ?, total = ?, pelanggan_id = ?
            WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ssisi', $waktu_transaksi, $keterangan, $total, $pelanggan_id, $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

function deleteTransaksi($conn, $id){
    $sql_cek = "SELECT * FROM transaksi_detail WHERE transaksi_id = ?";
    $prepare_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($prepare_cek, 'i', $id);
    mysqli_stmt_execute($prepare_cek);
    mysqli_stmt_store_result($prepare_cek);

    if(mysqli_stmt_num_rows($prepare_cek) > 0) {
        return -1;
    }

    $sql = "DELETE FROM transaksi WHERE id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'i', $id);
    mysqli_stmt_execute($prepare);

    return mysqli_stmt_affected_rows($prepare);
}

// Fungsi Database Transaksi Detail
function insertTransaksiDetail($conn, $data){

    $barang_id = (int) htmlspecialchars($data["barang_id"]);
    $barang = getData($conn, "SELECT * FROM barang WHERE id = $barang_id")[0];

    $transaksi_id = htmlspecialchars($data["transaksi_id"]);
    $qty = (int) htmlspecialchars($data["qty"]);
    $harga = (int) (htmlspecialchars($barang["harga"])) * $qty;

    $sql = "INSERT INTO transaksi_detail VALUES (?, ?, ?, ?)";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'iiii', $transaksi_id, $barang_id, $harga, $qty);
    mysqli_stmt_execute($prepare);

    tambahTotalHarga($conn, $transaksi_id, $harga);
    kurangStokBarang($conn, $barang_id, $qty);
    return mysqli_stmt_affected_rows($prepare);
}

function deleteTransaksiDetail($conn, $transaksiID, $barangID){
    $transaksiDetail = getData($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id = $transaksiID AND barang_id = $barangID")[0];
    $harga = $transaksiDetail["harga"];
    $qty = $transaksiDetail["qty"];

    $sql = "DELETE FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ii', $transaksiID, $barangID);
    mysqli_stmt_execute($prepare);
    kurangTotalHarga($conn, $transaksiID, $harga);
    tambahStokBarang($conn, $barangID, $qty);
    return mysqli_stmt_affected_rows($prepare);
}

function tambahTotalHarga($conn, $transaksiID, $harga){
    $sql = "UPDATE transaksi
            SET total = total + ?
            WHERE id = ?
        ";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ii', $harga, $transaksiID);
    mysqli_stmt_execute($prepare);
}

function kurangTotalHarga($conn, $transaksiID, $harga){
    $sql = "UPDATE transaksi
            SET total = total - ?
            WHERE id = ?
        ";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ii', $harga, $transaksiID);
    mysqli_stmt_execute($prepare);
}

function tambahStokBarang($conn, $barangID, $qty){
    $sql = "UPDATE barang
            SET stok = stok + ?
            WHERE id = ?
        ";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ii', $qty, $barangID);
    mysqli_stmt_execute($prepare);
}

function kurangStokBarang($conn, $barangID, $qty){
    $sql = "UPDATE barang
            SET stok = stok - ?
            WHERE id = ?
        ";
    $prepare = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($prepare, 'ii', $qty, $barangID);
    mysqli_stmt_execute($prepare);
}





?>