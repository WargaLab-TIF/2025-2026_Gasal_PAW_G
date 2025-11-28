<?php 
require "functions.php";

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($servername, $username, $password, $database);
$query = mysqli_query($conn, "SELECT * FROM supplier");

if(isset($_GET["id"])){
    if (delete($conn, $_GET["id"]) > 0) {
        echo "
            <script> 
            alert('Data berhasil dihapus');
            document.location.href = 'index.php'
            </script>
        ";
        } else {
        echo "
            <script> 
            alert('Data gagal dihapus');
            document.location.href = 'index.php'
            </script>
        ";
        };
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Master Supplier</title>
  <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #FAF8F5;
      display: flex;
      justify-content: center;
      min-height: 100vh;
    }

    .container {
      padding: 40px;
      width: 80%;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .header h1 {
      font-size: 24px;
      font-weight: 700;
      color: #222222ff;
      margin: 0;
    }

    .btn {
      padding: 8px 16px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      color: #ffffffff;
      font-size: 14px;
    }

    .add {
        background-color: #8AC44B;
    }
    .edit {
        background-color: #478ECC;
    }
    .delete {
        background-color: #FF383C;
    }

    .btn:hover {
      opacity: 0.75;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      background-color: #ffffffff;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    th {
      background-color: #F4F7FA;
      color: #333333ff;
      padding: 12px;
      text-align: left;
      font-weight: 600;
    }

    td {
      padding: 10px 12px;
      border-top: 1px solid #cececeff;
      text-align: left;
      color: #333333ff;
    }
    .action{
        text-align: center;
    }
    tr:hover {
      background-color: #f9f9f9;
    }

  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Data Master Supplier</h1>
      <a href="insert.php" class="btn add">+ Tambah Data</a>
    </div>

    <table>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th class="action">Tindakan</th>
      </tr>

      <?php 
      $num = 1;
      while($row = mysqli_fetch_assoc($query)): ?>
        <tr>
          <td><?= $num ?></td>
          <td><?= $row["nama"] ?></td>
          <td><?= $row["telp"] ?></td>
          <td><?= $row["alamat"] ?></td>
          <td class="action">
            <a href="edit.php?id=<?= $row["id"]?>" class="btn edit">Edit</a>
            <a href="index.php?id=<?= $row["id"]?>" class="btn delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php 
        $num++;
        endwhile; 
      ?>
    </table>
  </div>
</body>
</html>




