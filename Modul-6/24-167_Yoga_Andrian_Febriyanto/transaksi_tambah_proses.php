<?php
session_start();
require_once "../../core/conn.php";
require_once "../module/helper.php";

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu_transaksi = $_POST["waktu_transaksi"] ?? "";
    $keterangan = $_POST["keterangan"] ?? "";
    $total = $_POST["total"] ?? 0;
    $pelanggan_id = $_POST["pelanggan_id"] ?? "";

    if (empty($waktu_transaksi) || empty($keterangan) || empty($pelanggan_id)) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Semua field wajib diisi."
        ];
        header("Location: ../../transaksi_tambah.php");
        exit;
    }

    $user_id = 1;

    $insert_transaksi = "
        INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
        VALUES ('$waktu_transaksi', '$keterangan', $total, '$pelanggan_id', $user_id)
    ";

    try {
        if (mysqli_query($conn, $insert_transaksi)) {
            $transaksi_id = mysqli_insert_id($conn);

            $_SESSION["notif"] = [
                "judul" => "Berhasil Menambah",
                "pesan" => "Data transaksi berhasil disimpan."
            ];

            header("Location: ../../transaksi_detail_tambah.php?transaksi_id=$transaksi_id");
            exit;
        } else {
            throw new Exception("Gagal menyimpan data transaksi.");
        }
    } catch (Exception $err) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menambah",
            "pesan" => "Gagal menyimpan data transaksi: " . $err->getMessage()
        ];
        header("Location: ../../transaksi_tambah.php");
        exit;
    }
} else {
    header("Location: ../../transaksi_tambah.php");
    exit;
}