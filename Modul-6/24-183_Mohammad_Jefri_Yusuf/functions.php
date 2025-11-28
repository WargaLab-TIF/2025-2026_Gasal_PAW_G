<?php 


function getData($conn, $sql){
    $query = mysqli_query($conn, $sql);
    $result = [];
    while ($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }
    if(count($result) === 1){
        return $result[0];
    }
    return $result;
}

function insertDataTransaksi($conn, $waktuTransaksi, $keterangan, $total, $pelangganID)
{
    $query = "INSERT INTO transaksi VALUES('','$waktuTransaksi', '$keterangan', '$total', '$pelangganID')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};

function insertTransaksiDetail($conn, $transaksiID, $barangID, $qty){
    
    $barang = getData($conn, "SELECT * FROM barang WHERE id = $barangID");
    $harga = $barang["harga"] * $qty;

    $query = "INSERT INTO transaksi_detail VALUES('$transaksiID', '$barangID', '$harga', $qty)";
    mysqli_query($conn, $query);

    updateTotalTransaksi($conn, $transaksiID, $harga);

    return mysqli_affected_rows($conn);

}

function deleteBarang($conn, $id){

    $listTransaksiDetail = getData($conn, "SELECT * FROM transaksi_detail WHERE barang_id = $id");
    if(count($listTransaksiDetail) > 0){
        return 0;
    }
    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function updateTotalTransaksi($conn, $id, $harga){
    $query = "UPDATE transaksi
            SET total = total + $harga
            WHERE id = $id 
        ";
    mysqli_query($conn, $query);
}
?>