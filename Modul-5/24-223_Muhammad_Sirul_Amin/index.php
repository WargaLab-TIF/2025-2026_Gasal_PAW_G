<?php
require_once 'db.php';

function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $mysqli->prepare("DELETE FROM supplier WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}

// ambil data
$res = $mysqli->query("SELECT id, nama, telp, alamat FROM supplier ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Data Master Supplier</title>
<script>
function confirmDelete(id, name){
    if(confirm("Hapus data supplier: " + name + "?")){
        window.location.href = "index.php?action=delete&id=" + id;
    }
}
</script>
</head>
<body style="font-family:Arial, sans-serif; margin:20px; background:#fafafa;">
<h2 style="margin-bottom:10px; color: #6990baff">Data Master Supplier</h2>
<div style="text-align:right; margin-bottom:10px;">
  <a href="add.php" 
     style="display:inline-block; 
            padding:6px 10px; 
            background:#007bff; 
            color:#fff; 
            border-radius:4px; 
            text-decoration:none;">
    + Tambah Data
  </a>
</div>


<table style="width:100%; border-collapse:collapse; ;">
    <thead>
        <tr style="background:#e7f3ff;">
            <th style="border:1px solid; padding:8px;">#</th>
            <th style="border:1px solid; padding:8px;">Nama</th>
            <th style="border:1px solid; padding:8px;">Telp</th>
            <th style="border:1px solid; padding:8px;">Alamat</th>
            <th style="border:1px solid; padding:8px;">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($res && $res->num_rows > 0): ?>
            <?php while($row = $res->fetch_assoc()): ?>
            <tr>
                <td style="border:1px solid; padding:8px;"><?php echo e($row['id']); ?></td>
                <td style="border:1px solid; padding:8px;"><?php echo e($row['nama']); ?></td>
                <td style="border:1px solid; padding:8px;"><?php echo e($row['telp']); ?></td>
                <td style="border:1px solid; padding:8px;"><?php echo e($row['alamat']); ?></td>
                <td style="border:1px solid; padding:8px; white-space:nowrap;">
                    <a href="edit.php?id=<?php echo e($row['id']); ?>" 
                       style="background:#ff9800; color:#fff; padding:4px 8px; border-radius:4px; text-decoration:none; margin-right:4px;">Edit</a>
                    <a href="javascript:void(0)" 
                       onclick="confirmDelete(<?php echo e($row['id']); ?>,'<?php echo e($row['nama']); ?>')"
                       style="background:#f44336; color:#fff; padding:4px 8px; border-radius:4px; text-decoration:none;">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5" style="border:1px solid #ddd; padding:8px; text-align:center;">Belum ada data.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</body>
</html>
