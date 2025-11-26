<?php
include "header.php";
$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT * FROM pelanggan";
$result = mysqli_query($conn, $query);
$pelanggan = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['tambah'])) {
    header("location:./crud/pelanggan/tbpelanggan.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
</head>
<style>
    table {
        box-shadow: 0px 4px 20px black;
        border-radius: 10px;
        padding: 15px;
    }

    th {
        background-color: lightgray;
        border-radius: 10px;
    }

    td:hover {
        background-color: grey;
        border-radius: 10px;
    }

    .delete {
        background-color: red;
        padding: 7px;
        color: black;
        border-radius: 10px;
        border: none;
        text-decoration: none;
    }

    .delete:hover {
        background-color: black;
        color: red;
        padding: 7px;
        border-radius: 10px;
        border: none;
        text-decoration: none;
    }

    .edit {
        background-color: lightskyblue;
        text-decoration: none;
        color: black;
        padding: 7px;
        border-radius: 10px;
        border: none;
    }

    .edit:hover {
        background-color: black;
        color: lightskyblue;
        padding: 7px;
        border-radius: 10px;
        border: none;
        text-decoration: none;
    }

    .tambah {
        background-color: lightslategray;
        color: white;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 7px;
        border: none;
        border-radius: 10px;
        margin-left: 10px;
    }

    .tambah:hover {
        background-color: black;
        color: lightskyblue;
        margin-bottom: 20px;
        padding: 7px;
        border: none;
        border-radius: 10px;
        margin-left: 10px;
    }

    .pelanggan {
        width: auto;
        margin: 0;
        padding: 10px;
        background-color: grey;
        color: white;
        text-align: center;
    }
</style>

<body>
    <h2 class="pelanggan">Pelanggan</h2>
    <form action="pelanggan.php" method="post">
        <button type="submit" name="tambah" class="tambah">Tambah Data Pelanggan</button>
    </form>
    <table cellpadding="15px" cellspacing="15px">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
        <?php foreach ($pelanggan as $p): ?>
            <tr>
                <td><?php echo $p['id'] ?></td>
                <td><?php echo $p['nama'] ?></td>
                <td><?php echo $p['jenis_kelamin'] ?></td>
                <td><?php echo $p['telp'] ?></td>
                <td><?php echo $p['alamat'] ?></td>
                <td>
                    <form action="pelanggan.php" method="post">
                        <a href="./crud/pelanggan/edpelanggan.php?id=<?= $p['id'] ?>" class="edit">Edit</a>
                        <a href="./crud/pelanggan/delpelanggan.php?id=<?= $p['id'] ?>" class="delete" onclick="return confirm('Apakah Anda Yakin Menghapus data ini?')">Delete</a>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>