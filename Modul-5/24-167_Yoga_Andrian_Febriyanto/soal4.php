<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
		.btn-edit {
			background-color: #FF8C00; 
			color: white;
			border: none;
			padding: 5px 10px;
			text-decoration: none;
			border-radius: 3px;
			font-size: 12px;
		}
		.btn-hapus {
			background-color: #DC143C; 
			color: white;
			border: none;
			padding: 5px 10px;
			text-decoration: none;
			border-radius: 3px;
			font-size: 12px;
		}
		.btn-tambah {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 8px 16px;
			text-decoration: none;
			border-radius: 4px;
			font-size: 14px;
			float: right;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 10px;
		}
		th, td {
			padding: 8px;
			text-align: left;
			border: 1px solid #ddd;
		}
		th {
			background-color: #eaf2f8;
		}
	</style>
</head>
<body>
    <?php
        $koneksi = mysqli_connect("localhost","root","","store") or die(mysqli_error());
        function tambah($koneksi){}
        function ubah($koneksi){}
        function hapus($koneksi){
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                $sql = "DELETE FROM supplier WHERE id = $id";
                if (mysqli_query($koneksi, $sql)) {
                    header("Location: soal3.php");
                    exit();
                } else {
                    echo "<div style='color:red;'>Gagal menghapus data.</div>";
                }
            }
        }
        function tampil_data($koneksi){
        $sql = "SELECT * FROM supplier";
        $query = mysqli_query($koneksi, $sql);
        
        echo "<fieldset>";
        echo "<legend><h2>Data Master Supplier</h2></legend>";
        echo '<a href="?aksi=create" class="btn-tambah">Tambah Data</a>';
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>";
        
        $no = 1;
        while($data = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['telp']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td>
                        <a href="?aksi=update&id=<?php echo $data['id']; ?>&nama=<?php echo urlencode($data['nama']); ?>&telp=<?php echo $data['telp']; ?>&alamat=<?php echo urlencode($data['alamat']); ?>" class="btn-edit">Edit</a> |
                        <a href="?aksi=delete&id=<?php echo $data['id']; ?>" class="btn-hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
                    </td>
                </tr>
            <?php
        }
        echo "</table>";
        echo "</fieldset>";
    }

    if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="soal3.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
        }
    } else {
        tampil_data($koneksi);
    }




    ?>
</body>
</html>