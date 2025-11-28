<?php
session_start();
require_once "../../core/conn.php";
require_once "../../proses/module/helper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $check_sql = "SELECT * FROM transaksi_detail WHERE barang_id = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION["notif"] = [
            "judul" => "Gagal Menghapus",
            "pesan" => "Barang tidak dapat dihapus karena sudah digunakan dalam transaksi detail."
        ];
    } else {
        $delete_sql = "DELETE FROM barang WHERE id = '$id'";
        if (mysqli_query($conn, $delete_sql)) {
            $_SESSION["notif"] = [
                "judul" => "Berhasil Menghapus",
                "pesan" => "Data barang berhasil dihapus."
            ];
        } else {
            $_SESSION["notif"] = [
                "judul" => "Gagal Menghapus",
                "pesan" => "Gagal menghapus data barang: " . mysqli_error($conn)
            ];
        }
    }

    header("Location: /MasterDetail/in_barang.php");
    exit;
} else {
    header("Location: /MasterDetail/in_barang.php");
    exit;
}
?>