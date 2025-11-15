<?php
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $database = "store";

    $conn = mysqli_connect($server, $user, $pass, $database);

    $supplier = mysqli_query($conn, "SELECT * FROM supplier");
    $result = mysqli_fetch_all($supplier, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
    <style>
        body {
            margin: 0;
        }
        div {
            display: flex;
            box-shadow: 2px 2px 5px grey;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        div a {
            position: absolute;
            right: 1%;
            background-color: greenyellow;
            padding: 1vh 2vh;
            text-decoration: none;
            border-radius: 10px;
            box-shadow: 2px 2px 5px grey;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        table td,
        table th {
            height: 5vh;
            border-bottom: 1px solid grey;
        }
        table th {
            background-color: rgba(172, 255, 47, 0.397);
        }
        table td .hapus {
            background-color: red;
        }
        table td .edit {
            background-color: blueviolet;
        }
        table td a {
            color: white;
            border-radius: 10px;
            box-shadow: 2px 2px 5px grey;
            padding: 1vh 2vh;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div>
        <h1>Data Master Supplier</h1>
        <a href="Tugas-2.php">Tambah Data</a>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php foreach($result as $r): ?>
            <tr>
                <td><?php echo $r["id"]; ?></td>
                <td><?php echo $r["nama"]; ?></td>
                <td><?php echo $r["telp"]; ?></td>
                <td><?php echo $r["alamat"]; ?></td>
                <td>
                    <a href="Tugas-3.php?id=<?php echo $r["id"]; ?>" class="edit">Edit</a>
                    <a href="Tugas-4.php?id=<?php echo $r["id"]; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>