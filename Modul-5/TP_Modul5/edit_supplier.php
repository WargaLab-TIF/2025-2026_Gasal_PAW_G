<?php
include "koneksi.php";

// Pastikan parameter id dikirim
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "<p style='color:red;'>ID supplier tidak ditemukan di URL.</p>";
    exit;
}

$id = $_GET["id"];

// Jalankan query ambil data supplier
$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier = '$id'");

// Cek apakah query berhasil dan ada hasilnya
if ($query && mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    $nama = $data["nama"];
    $telp = $data["telp"];
    $alamat = $data["alamat"];
} else {
    echo "<p style='color:red;'>Data supplier dengan ID $id tidak ditemukan.</p>";
    $nama = $telp = $alamat = "";
}

// Inisialisasi array error
$error = [];

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    // Validasi nama hanya huruf dan spasi
    if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $error["nama"] = "Nama cuma boleh huruf!";
    }

    // Validasi telepon hanya angka
    if (empty($telp) || !preg_match("/^[0-9]+$/", $telp)) {
        $error["telp"] = "Nomor telepon hanya boleh angka!";
    }

    // Validasi alamat harus mengandung huruf dan angka
    if (empty($alamat) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat)) {
        $error["alamat"] = "Alamat harus berisi huruf dan angka!";
    }

    // Jika tidak ada error, update data
    if (empty($error)) {
        $ubah = "UPDATE supplier SET 
                    nama='$nama', 
                    telp='$telp', 
                    alamat='$alamat' 
                 WHERE id_supplier='$id'";

        $hasil = mysqli_query($koneksi, $ubah);

        if ($hasil) {
            header("Location: supplier.php");
            exit;
        } else {
            echo "<p style='color:red;'>Gagal memperbarui data: " . mysqli_error($koneksi) . "</p>";
        }
    }
}
?>

<h3>Edit Data Supplier</h3>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($nama); ?>"><br>
    <small style="color:red;"><?= $error["nama"] ?? ""; ?></small><br>

    <label>No. Telepon:</label><br>
    <input type="text" name="telp" value="<?= htmlspecialchars($telp); ?>"><br>
    <small style="color:red;"><?= $error["telp"] ?? ""; ?></small><br>

    <label>Alamat:</label><br>
    <input type="text" name="alamat" value="<?= htmlspecialchars($alamat); ?>"><br>
    <small style="color:red;"><?= $error["alamat"] ?? ""; ?></small><br><br>

    <button type="submit">Simpan Perubahan</button>
    <a href="supplier.php">Batal</a>
</form>
