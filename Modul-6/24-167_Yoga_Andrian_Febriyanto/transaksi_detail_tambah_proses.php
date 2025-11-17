<?php
session_start();
require_once "../../core/conn.php";
require_once "../module/helper.php";

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $transaksi_id = $_POST["transaksi_id"] ?? null;
    $barang_id = $_POST["barang_id"] ?? null;
    $qty = $_POST["qty"] ?? 0;

    // Validasi input
    if (!$transaksi_id || !$barang_id || $qty <= 0) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Data tidak valid."
        ];
        header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
        exit;
    }

    $transaksi_id = mysqli_real_escape_string($conn, $transaksi_id);
    $barang_id = mysqli_real_escape_string($conn, $barang_id);
    $qty = mysqli_real_escape_string($conn, $qty);

    $check_sql = "SELECT * FROM transaksi_detail WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Barang ini sudah dipilih untuk transaksi ini."
        ];
        header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
        exit;
    }

    $harga_sql = "SELECT harga FROM barang WHERE id = '$barang_id'";
    $harga_result = mysqli_query($conn, $harga_sql);
    
    if (!$harga_result) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Gagal mengambil harga barang: " . mysqli_error($conn)
        ];
        header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
        exit;
    }

    $harga_row = mysqli_fetch_assoc($harga_result);
    if (!$harga_row) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Barang dengan ID $barang_id tidak ditemukan."
        ];
        header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
        exit;
    }
    $harga = $harga_row['harga'];

    $total_harga_item = $harga * $qty;

    $insert_detail = "
        INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
        VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')
    ";

    try {
        if (mysqli_query($conn, $insert_detail)) {

            $calculate_total_sql = "
                SELECT SUM(harga * qty) as new_total 
                FROM transaksi_detail 
                WHERE transaksi_id = '$transaksi_id'
            ";
            $calculate_result = mysqli_query($conn, $calculate_total_sql);
            $total_row = mysqli_fetch_assoc($calculate_result);
            $new_total = $total_row['new_total'] ?? 0;

            $update_total_sql = "
                UPDATE transaksi 
                SET total = '$new_total' 
                WHERE id = '$transaksi_id'
            ";
            if (!mysqli_query($conn, $update_total_sql)) {
                throw new Exception("Gagal memperbarui total transaksi: " . mysqli_error($conn));
            }

            $_SESSION["notif"] = [
                "judul" => "Berhasil Menambah",
                "pesan" => "Detail transaksi berhasil disimpan dan total transaksi diperbarui."
            ];

            header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
            exit;
        } else {
            throw new Exception("Gagal menyimpan detail transaksi: " . mysqli_error($conn));
        }
    } catch (Exception $err) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Gagal menyimpan detail transaksi: " . $err->getMessage()
        ];
        header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
        exit;
    }
} else {
    header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
    exit;
}