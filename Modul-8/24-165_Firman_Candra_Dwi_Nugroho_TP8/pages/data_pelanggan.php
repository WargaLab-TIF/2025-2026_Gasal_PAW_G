<h2>Data Pelanggan</h2>
<a href="?page=pelanggan_add">+ Tambah Pelanggan</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>No Telp</th>
        <th>Aksi</th>
    </tr>

    <?php
    include 'config.php';
    $no = 1;
    $query = mysqli_query($conn, "SELECT * FROM pelanggan");

    while($row = mysqli_fetch_assoc($query)){
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_pelanggan']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['no_telp']; ?></td>
        <td>
            <a href="?page=pelanggan_edit&id=<?= $row['id_pelanggan']; ?>">Edit</a> |
            <a href="?page=pelanggan_hapus&id=<?= $row['id_pelanggan']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
