<?php
require_once "functions.php";

// Table Transaksi

function validateWaktuTransaksi(&$errors, $field){

    date_default_timezone_set('Asia/Jakarta');

    if(empty($field)){
        $errors["waktu_transaksi"] = "Pilih tanggal transaksi";
    } elseif($field < date('Y-m-d')){
        $errors["waktu_transaksi"] = "Tanggal tidak boleh kurang dari tanggal hari ini";
    }
}

function validateKeterangan(&$errors, $field){
    if(empty($field)){
        $errors["keterangan"] = "Keterangan tidak boleh kosong";
    } elseif(strlen($field) < 3) {
        $errors["keterangan"] = "Panjang minimal 3 karakter";
    }
}

function validatePelangganID(&$errors, $field){
    if(empty($field)){
        $errors["pelanggan_id"] = "Pelanggan tidak boleh kosong";
    }
}

// Table Transaksi Detail

function validateBarangID(&$errors,$conn, $barangID, $transaksiID){
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
    } elseif($field < 1){
        $errors["qty"] = "Nilai quantity tidak boleh kurang dari 1";
    }
}
?>