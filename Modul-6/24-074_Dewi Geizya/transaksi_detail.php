<?php
include 'koneksi.php';
$errors=[]; $success='';

$transaksi=$conn->query("SELECT transaksi_id FROM transaksi");
$barang=$conn->query("SELECT barang_id,nama_barang FROM barang");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $transaksi_id=$_POST['transaksi_id']??'';
    $barang_id=$_POST['barang_id']??'';
    $qty=$_POST['qty']??0;

  
    $cek=$conn->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE transaksi_id=? AND barang_id=?");
    $cek->bind_param("ii",$transaksi_id,$barang_id);
    $cek->execute();
    $cek->bind_result($count); $cek->fetch(); $cek->close();

    if($count>0){
        $errors[]="Barang ini sudah ditambahkan dalam transaksi tersebut.";
    }else{
        $h=$conn->prepare("SELECT harga FROM barang WHERE barang_id=?");
        $h->bind_param("i",$barang_id); $h->execute();
        $h->bind_result($harga_satuan); $h->fetch(); $h->close();
        $harga_total=$harga_satuan*$qty;

        $stmt=$conn->prepare("INSERT INTO transaksi_detail (transaksi_id,barang_id,harga,qty) VALUES (?,?,?,?)");
        $stmt->bind_param("iiii",$transaksi_id,$barang_id,$harga_total,$qty);
        if($stmt->execute()){
            $conn->query("UPDATE transaksi SET total=(SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id=$transaksi_id) WHERE transaksi_id=$transaksi_id");
            $success="Detail berhasil ditambahkan dan total diperbarui.";
        }else{
            $errors[]="Gagal menambah: ".$stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Detail Transaksi</title>
<style>
body{font-family:Arial;background:#f8f9fa;}
form{width:350px;margin:30px auto;padding:15px;background:#fff;border-radius:8px;}
label{display:block;margin-top:10px;}
input,select{width:100%;padding:8px;}
button{margin-top:15px;padding:10px;background: #b9bcd2ff;;color:white;border:none;width:100%;}
.error{color:red;} .success{color:green;}
</style>
</head>
<body>
<form method="post">
<h3>Tambah Detail Transaksi</h3>
<?php if($errors): ?><div class="error"><ul><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul></div><?php endif; ?>
<?php if($success): ?><div class="success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<label>Transaksi</label>
<select name="transaksi_id" required>
<option value="">-- Pilih Transaksi --</option>
<?php while($t=$transaksi->fetch_assoc()): ?>
<option value="<?= $t['transaksi_id'] ?>"><?= $t['transaksi_id'] ?></option>
<?php endwhile; ?>
</select>
<label>Barang</label>
<select name="barang_id" required>
<option value="">-- Pilih Barang --</option>
<?php while($b=$barang->fetch_assoc()): ?>
<option value="<?= $b['barang_id'] ?>"><?= $b['nama_barang'] ?></option>
<?php endwhile; ?>
</select>
<label>Qty</label>
<input type="number" name="qty" min="1" required>
<button type="submit">Tambah Detail</button>
</form>
</body>
</html>
