<h2>Data Supplier</h2>
<a href="?page=supplier_add">+ Tambah Supplier</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>No Telp</th>
        <th>Aksi</th>
    </tr>

    <?php
    include 'config.php';

    $no = 1;
    $query = mysqli_query($conn, "SELECT * FROM supplier");

    while($row = mysqli_fetch_assoc($query)){
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_supplier']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['no_telp']; ?></td>
        <td>
            <a href="?page=supplier_edit&id=<?= $row['id']; ?>">Edit</a> |
            <a href="?page=supplier_hapus&id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
