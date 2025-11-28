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
        function validatenama(&$errors, $field){
            $field = trim($field);
            
            if (empty($field)){
                $errors['nama'] = 'nama wajib di isi';
            } elseif (!preg_match("/^[a-zA-Z\s'-]+$/",$field)){
                $errors['nama'] = 'nama wajib huruf';
            }
        }
        function validatetelp(&$errors,$field){
            $field = trim($field);
            if (empty($field)){
                $errors['telp'] = 'telepon wajib di isi';
            }elseif (!preg_match("/^[0-9]+$/",$field)){
                $errors['telp'] = 'telepon wajib anggka';
            }
        }
        function validatealamat(&$error,$field){
            $field = trim($field);
            if (empty($field)){
                $error['alamat'] = 'nama wajib di isi';
            }elseif (!preg_match("/[a-zA-Z]/", $field) || !preg_match("/[0-9]/", $field)){
                $error['alamat'] = 'alamat wajib alfanumerik';
            }
        }
        function tambah($koneksi){
            if (isset($_POST['btn_simpan'])){
                $errors = [];
                $nama = $_POST['nama'] ?? '';
                $telp = $_POST['telp'] ?? '';
                $alamat = $_POST['alamat'] ?? '';
                validatenama($errors, $nama);
                validatetelp($errors, $telp);
                validatealamat($errors, $alamat);
                if (empty($errors)){
                    $sql ="INSERT INTO supplier (nama,telp,alamat) VALUES ('$nama','$telp','$alamat')";
                    $simpan =mysqli_query($koneksi,$sql);
                    if ($simpan){
                        header ("location: soal2.php");
                    }
                }
            }
            ?> 
            <form action="" method="POST">
                <fieldset>
                    <legend><h2>Tambah Data Master Supplier Baru</h2></legend>
                    <label>Nama Supplier <input type="text" name="nama" /></label> 
                    <span><?= $errors['nama'] ?? "" ?></span><br>
                    <label>No. Telepon <input type="text" name="telp"/></label>
                    <span><?= $errors['telp'] ?? "" ?></span><br>
                    <label>Alamat <input type="text" name="alamat"  /></label>
                    <span><?= $errors['alamat'] ?? "" ?></span><br>
                    <br>
                    <label>
                        <input type="submit" name="btn_simpan" value="Simpan"/>
                        <input type="reset" name="reset" value="Bersihkan"/>
                    </label>
                    <br>
                </fieldset>
            </form>
        <?php
        }
        function ubah($koneksi){}
        function hapus($koneksi){}
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
                        <a href="?aksi=delete&id=<?php echo $data['id']; ?>" class="btn-hapus">Hapus</a>
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
			echo '<a href="soal2.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
        }
    } 
    else {
       
        tampil_data($koneksi);
    }




    ?>
</body>
</html>