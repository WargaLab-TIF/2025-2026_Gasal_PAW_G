<?php

include "koneksi.php";
//hapus data
if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    $query = "DELETE  FROM supplier WHERE  id= $id";

    if (mysqli_query($conn, $query)) {
        header("location: index.php");
        exit; // selalu tambahkan exit setelah header redirect
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}



$query = "SELECT * FROM supplier";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .btn-tambah {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-tambah a {
            text-decoration: none;
            color: white;
        }
        table {
            width: auto;
            margin: auto;

            background-color: #fff;

        }

        .edit {
            background-color: #f39c12;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .hapus {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header-container">
        <h2>Data Master Supplier</h2>
        <button class="btn-tambah">
            <a href="tambahData.php">Tambah Data</a>
        </button>
    </div>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr bgcolor="#90e0ef">
            <th>No</th>
            <th>nama</th>
            <th>telp</th>
            <th>alamat</th>
            <th colspan="2">tindakan</th>

        </tr>
        <?php foreach ($data as $dt): ?>
            <tr>
                <td><?php echo $dt["id"] ?></td>
                <td><?php echo $dt["nama"] ?></td>
                <td><?php echo $dt["telp"] ?></td>
                <td><?php echo $dt["alamat"] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $dt["id"] ?>" class="edit">edit</a>
                    <a href="index.php?id=<?php echo $dt["id"]; ?>" class="hapus"
                        onclick="return confirm('Anda yakin akan menghapus supplier ini?');">
                        Hapus
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</body>

</html>