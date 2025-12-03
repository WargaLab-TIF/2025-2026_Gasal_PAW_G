<h2>Data Supplier</h2>
<a href="?page=supplier_add" class="btn btn-primary">+ Tambah Supplier</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>

    <?php
    include "config.php";

    // Ganti kolom sesuai database kamu
    $query = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id DESC");
    $no = 1;

    while ($row = mysqli_fetch_assoc($query)) {
        echo "
        <tr>
            <td>$no</td>
            <td>{$row['nama_supplier']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['no_telp']}</td>
            <td>
                <a href='?page=supplier_edit&id={$row['id']}'>Edit</a> |
                <a href='?page=supplier_delete&id={$row['id']}' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>
