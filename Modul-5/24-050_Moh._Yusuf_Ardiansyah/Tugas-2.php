<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "store";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nama = "";
$telp = "";
$alamat = "";
$error = "";

if (isset($_POST["simpan"])) {
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    if (empty($nama) || !preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error = "Nama wajib diisi dan hanya boleh huruf.";
    } elseif (empty($telp) || !preg_match("/^[0-9-]+$/", $telp)) {
        $error = "Telp wajib diisi serta hanya boleh angka dan -.";
    } elseif (empty($alamat) || 
             !preg_match("/[A-Za-z]/", $alamat) || 
             !preg_match("/[0-9]/", $alamat)) {
        $error = "Alamat wajib diisi dan harus mengandung huruf dan angka.";
    } else {
        $query = "INSERT INTO supplier (nama, telp, alamat) 
                  VALUES ('$nama', '$telp', '$alamat')";
        mysqli_query($conn, $query);
        header("Location: Tugas-1.php");
    }
}

if (isset($_POST["batal"])) {
    header("Location: Tugas-1.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Supplier</title>
</head>
<body>
    <h2>Tambah Data Supplier</h2>

    <?php if ($error != ""): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $nama; ?>"><br><br>

        <label>Telp:</label><br>
        <input type="text" name="telp" value="<?php echo $telp; ?>"><br><br>

        <label>Alamat:</label><br>
        <input type="text" name="alamat" value="<?php echo $alamat; ?>"><br><br>

        <button type="submit" name="simpan">Simpan</button>
        <button type="submit" name="batal">Batal</button>
    </form>
</body>
</html>