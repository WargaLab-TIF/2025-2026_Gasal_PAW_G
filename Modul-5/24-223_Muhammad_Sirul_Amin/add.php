<?php
require_once 'db.php';

$errors = [];
$nama = $telp = $alamat = "";

function old($k){ global $$k; return htmlspecialchars($$k, ENT_QUOTES, 'UTF-8'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : "";
    $telp = isset($_POST['telp']) ? trim($_POST['telp']) : "";
    $alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : "";

    // Validasi nama: tidak kosong, hanya huruf dan spasi
    if ($nama === "") {
        $errors['nama'] = "Nama tidak boleh kosong.";
    } elseif (!preg_match('/^[\p{L}\s]+$/u', $nama)) {
        $errors['nama'] = "Nama hanya boleh huruf dan spasi.";
    }

    // sama kayak diatas
    if ($telp === "") {
        $errors['telp'] = "Telepon tidak boleh kosong.";
    } elseif (!preg_match('/^\d+$/', $telp)) {
        $errors['telp'] = "Telepon hanya boleh angka.";
    }

    // sama kayak diatas
    if ($alamat === "") {
        $errors['alamat'] = "Alamat tidak boleh kosong.";
    } else {
        if (!preg_match('/[0-9]/', $alamat) || !preg_match('/\p{L}/u', $alamat)) {
            $errors['alamat'] = "Alamat harus alfanumerik dan mengandung minimal 1 huruf dan 1 angka.";
        }
    }

    if (empty($errors)) {
        $stmt = $mysqli->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $telp, $alamat);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Data Supplier</title>
    <style>
        body{font-family:Arial; margin:20px;}
        .error{color: #b00;}
        label{display:block; margin-top:8px;}
        input[type=text], textarea{width:100%; padding:6px;}
        .btn{padding:8px 12px; text-decoration:none; border-radius:4px; border:1px solid #333; display:inline-block; margin-top:10px;}
    </style>
</head>
<body>
    <h2>Tambah Data Supplier</h2>
    <form method="post" action="add.php" novalidate>
        <label>Nama
            <input type="text" name="nama" value="<?php echo old('nama'); ?>">
            <?php if(isset($errors['nama'])): ?><div class="error"><?php echo $errors['nama']; ?></div><?php endif; ?>
        </label>

        <label>Telp
            <input type="text" name="telp" value="<?php echo old('telp'); ?>">
            <?php if(isset($errors['telp'])): ?><div class="error"><?php echo $errors['telp']; ?></div><?php endif; ?>
        </label>

        <label>Alamat
            <textarea name="alamat"><?php echo old('alamat'); ?></textarea>
            <?php if(isset($errors['alamat'])): ?><div class="error"><?php echo $errors['alamat']; ?></div><?php endif; ?>
        </label>

        <button class="btn" type="submit">Simpan</button>
        <a class="btn" href="index.php">Batal</a>
    </form>
</body>
</html>
