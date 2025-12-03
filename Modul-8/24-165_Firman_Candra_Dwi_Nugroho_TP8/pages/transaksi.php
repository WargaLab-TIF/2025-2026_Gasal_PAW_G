<?php
include "config.php";

// Proses Simpan Transaksi
if(isset($_POST['submit'])){
    $id_barang = $_POST['id'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total_harga = 0;

    foreach($id_barang as $index => $value){
        $jml = $jumlah[$index];
        $hrg = $harga[$index];
        $sub_total = $jml * $hrg;
        $total_harga += $sub_total;

        mysqli_query($conn, "INSERT INTO transaksi (id_transaksi, jumlah, total) 
        VALUES ('$value', '$jml', '$sub_total')");
    }

    echo "<script>alert('Transaksi Berhasil Disimpan. Total: Rp $total_harga');</script>";
}
?>

<h2>Transaksi</h2>

<form method="POST">
<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>Pilih</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
    </tr>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM barang");
    while($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td align="center">
                <<input type="checkbox" name="id[]" value="<?php echo $row['id']; ?>">
            </td>

            <td><?php echo $row['nama_barang']; ?></td>

            <td>
                <input type="text" name="harga[]" value="<?php echo $row['harga']; ?>" readonly>
            </td>

            <td>
                <input type="number" name="jumlah[]" min="1" value="1">
            </td>
        </tr>

    <?php } ?>
</table>

<br>
<button type="submit" name="submit">Simpan Transaksi</button>
</form>
