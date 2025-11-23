<?php
    // koneksi ke database
    $server = "localhost";
    $username = "root";
    $pass = "root";
    $db = "store";

    $conn = mysqli_connect($server, $username, $pass, $db);

    // query ambil data pelanggan
    $query1 = mysqli_query($conn, "SELECT * FROM pelanggan");
    $data_pelanggan = mysqli_fetch_all($query1, MYSQLI_ASSOC);
    asort($data_pelanggan);

    // query ambil data barang
    $query2 = mysqli_query($conn, "SELECT * FROM barang");
    $data_barang = mysqli_fetch_all($query2, MYSQLI_ASSOC);
    asort($data_barang);

    // query ambil data transaksi
    $query3 = mysqli_query($conn, "SELECT * FROM transaksi");
    $data_transaksi = mysqli_fetch_all($query3, MYSQLI_ASSOC);
    asort($data_transaksi);

    // query ambil data transaksi_detail
    $query4 = mysqli_query($conn, "SELECT DISTINCT * FROM transaksi_detail");
    $data_transaksi_detail = mysqli_fetch_all($query4, MYSQLI_ASSOC);
    asort($data_transaksi_detail);

    // query untuk update setelah user menambahkan data pada transaksi_detail
    function update($data_transaksi_detail) {
        global $conn;
        foreach($data_transaksi_detail as $d) {
            // query untuk seleksi transaksi_id yang sama
            $transaksi_id = (int)$d['transaksi_id'];
            $query = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
            $tambah = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $hasil = 0;
            foreach($tambah as $t) {
                $hasil += (int)$t['harga'] * (int)$t['qty'];
            }
            mysqli_query($conn, "UPDATE transaksi SET total = $hasil WHERE id = $transaksi_id");
        }
    }

    // query penambahan data pada transaksi
    function tambahTransaksi($waktu_transaksi, $keterangan, $total, $pelanggan_id) {
        global $conn;
        (int)$total;
        (int)$pelanggan_id;
        mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) 
        VALUES ('$waktu_transaksi', '$keterangan', $total, $pelanggan_id)");
    }

    // query penambahan data pada detail_transaksi
    function tambahDetailTransaksi($barang, $transaksi, $qty) {
        global $conn, $data_transaksi_detail;
        (int)$barang;
        (int)$transaksi;
        (int)$qty;

        // query untuk ambil harga
        $query_h = mysqli_query($conn, "SELECT * FROM barang WHERE id = $barang");
        $harga = $qty * (int)mysqli_fetch_all($query_h, MYSQLI_ASSOC)[0]['harga'];
        mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
        VALUES ($transaksi, $barang, $harga, $qty)");
    }
    
    // fungsi untuk validasi tanggal
    function validateDate($tanggal, &$msg) {
        if (empty($tanggal)) {
            $msg['waktu_transaksi'] = "Tidak boleh kosong";
        } elseif ($tanggal <= date('Y-m-d')) {
            $msg['waktu_transaksi'] = "Tanggal kurang dari sekarang";
        } else {
            $msg['waktu_transaksi'] = "";
        }
    }

    // fungsi untuk validasi keterangan
    function validateKeterangan($keterangan, &$msg) {
        if (empty($keterangan)) {
            $msg['keterangan'] = "Tidak boleh kosong";            
        } elseif (preg_match_all("/[^\s]/", $keterangan) >= 3) {
            $msg['keterangan'] = "";            
        } else {
            $msg['keterangan'] = "Kurang dari 3 karakter";            
        }
    }

    // fungsi untuk validasi keterangan
    function validateQty($qty, &$msg) {
        if (empty($qty)) {
            $msg['qty'] = "Tidak boleh kosong";            
        } elseif (preg_match("/^[0-9]+$/", $qty)) {
            $msg['qty'] = "";
        } else {
            $msg['qty'] = "Hanya boleh angka";            
        }
    }

    // fungsi untuk validasi barang
    function validateBarang($transaksi, $barang, &$msg) {
        // query untuk ambil transaksi_id
        global $conn;
        (int)$transaksi;
        $query_t = mysqli_query($conn, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi");
        $query_transaksi = mysqli_fetch_all($query_t, MYSQLI_ASSOC);

        // pengecekan barang ada atau tidak pada transaksi_detail
        $is_true = FALSE;
        foreach($query_transaksi as $tr) {
            if($tr['barang_id'] == $barang) {
                $is_true = TRUE;
            }
        }
        if ($is_true) {
            $msg['barang_id'] = "Sudah ada pada detail transaksi";
        } else {
            $msg['barang_id'] = "";
        }
    }
?>