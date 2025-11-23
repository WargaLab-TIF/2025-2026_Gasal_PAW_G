<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "store";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    header("Location: Tugas-1.php");
    exit;
}

$id = (int) $_GET['id'];
$sql = "SELECT * FROM supplier WHERE id = $id LIMIT 1";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
if (!$row) {
    echo "Data tidak ditemukan.";
    exit;
}

$nama   = $row['nama'];
$telp   = $row['telp'];
$alamat = $row['alamat'];
$error  = "";

if (isset($_POST['batal'])) {
    header("Location: Tugas-1.php");
    exit;
}

if (isset($_POST['update'])) {
    // ambil input dari form
    $nama   = trim($_POST['nama']);
    $telp   = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    if ($nama === "" || !preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error = "Nama wajib diisi dan hanya boleh huruf/spasi.";
    }
    elseif ($telp === "" || !preg_match("/^[0-9-]+$/", $telp)) {
        $error = "Telp wajib diisi dan hanya boleh angka.";
    }
    elseif ($alamat === "" || !preg_match("/[A-Za-z]/", $alamat) || !preg_match("/[0-9]/", $alamat)) {
        $error = "Alamat wajib diisi dan harus mengandung minimal 1 huruf dan 1 angka.";
    }
    else {
        $nama_db   = mysqli_real_escape_string($conn, $nama);
        $telp_db   = mysqli_real_escape_string($conn, $telp);
        $alamat_db = mysqli_real_escape_string($conn, $alamat);

        $sql_update = "UPDATE supplier 
                       SET nama = '$nama_db', telp = '$telp_db', alamat = '$alamat_db'
                       WHERE id = $id";
        if (mysqli_query($conn, $sql_update)) {
            header("Location: Tugas-1.php");
            exit;
        } else {
            $error = "Gagal update: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Edit Supplier</title>
</head>
<body>
    <h2>Edit Data Master Supplier</h2>

    <?php if ($error != ""): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $nama; ?>"><br><br>

        <label>Telp:</label><br>
        <input type="text" name="telp" value="<?php echo $telp; ?>"><br><br>

        <label>Alamat:</label><br>
        <input type="text" name="alamat" value="<?php echo $alamat; ?>"><br><br>

        <button type="submit" name="update">Update</button>
        <button type="submit" name="batal">Batal</button>
    </form>
</body>
</html>