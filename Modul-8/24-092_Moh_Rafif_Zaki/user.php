<?php
include "header.php";
$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT * FROM `user`";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

$level = [];
foreach ($user as $l) {
    if ($l['level'] == 1) {
        $level[$l['level']] = "admin";
    } else {
        $level[$l['level']] = "user biasa";
    }
}

if (isset($_POST['tambah'])) {
    header("location:./crud/user/tbuser.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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
        border-radius: 10px;
        border: none;
        text-decoration: none;
        color: black;
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
        padding: 7px;
        border-radius: 10px;
        border: none;
        color: black;
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

    .user {
        width: auto;
        margin: 0;
        padding: 10px;
        background-color: grey;
        color: white;
        text-align: center;
    }
</style>

<body>
    <h2 class="user">User</h2>
    <form action="user.php" method="post">
        <button type="submit" name="tambah" class="tambah">Tambah Data User</button>
    </form>
    <table cellpadding="15px" cellspacing="15px">
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        <?php foreach ($user as $u): ?>
            <tr>
                <td><?php echo $u['id_user'] ?></td>
                <td><?php echo $u['username'] ?></td>
                <td><?php echo $u['password'] ?></td>
                <td><?php echo $u['nama'] ?></td>
                <td><?php echo $u['hp'] ?></td>
                <td><?php echo $u['alamat'] ?></td>
                <td><?php echo $level[$u['level']] ?></td>
                <td>
                    <form action="user.php" method="post">
                        <a href="./crud/user/eduser.php?id=<?= $u['id_user'] ?>" class="edit">Edit</a>
                        <a href="./crud/user/deluser.php?id=<?= $u['id_user'] ?>" class="delete" onclick="return confirm('Apakah Anda Yakin Menghapus data ini?')">Delete</a>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>