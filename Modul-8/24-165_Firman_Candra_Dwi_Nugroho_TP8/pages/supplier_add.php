<h2>Tambah Supplier</h2>

<form action="" method="POST">
    <table>
        <tr>
            <td>Nama Supplier</td>
            <td><input type="text" name="nama_supplier" required></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><textarea name="alamat" required></textarea></td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td><input type="text" name="no_telp" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="simpan">SIMPAN</button></td>
        </tr>
    </table>
</form>

<?php
include 'config.php';

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['no_telp'];

    $query = mysqli_query($conn, "INSERT INTO supplier (nama_supplier, alamat, no_telp) VALUES ('$nama', '$alamat', '$telp')");

    if($query){
        echo "<script>alert('Data supplier berhasil ditambahkan');window.location.href='index.php?page=supplier';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }
}
?>
