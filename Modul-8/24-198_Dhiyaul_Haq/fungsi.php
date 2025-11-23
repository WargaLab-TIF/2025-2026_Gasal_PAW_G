<?php
    include "conn.php";

    // query ambil data pelanggan
    $stmt = $conn->prepare("SELECT * FROM pelanggan");
    $stmt->execute();
    $data_pelanggan = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    asort($data_pelanggan);

    // query ambil data barang
    $stmt = $conn->prepare("SELECT * FROM barang");
    $stmt->execute();
    $data_barang = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    asort($data_barang);

    // query ambil data transaksi
    $stmt = $conn->prepare("SELECT * FROM transaksi");
    $stmt->execute();
    $data_transaksi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    asort($data_transaksi);

    // query ambil data transaksi_detail
    $stmt = $conn->prepare("SELECT * FROM transaksi_detail");
    $stmt->execute();
    $data_transaksi_detail = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    asort($data_transaksi_detail);

    // query untuk ambil data user
    $stmt = $conn->prepare("SELECT * FROM user");
    $stmt->execute();
    $data_user = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    asort($data_user);

    // query untuk ambil data supplier
    $stmt = $conn->prepare("SELECT * FROM supplier");
    $stmt->execute();
    $data_supplier = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    asort($data_supplier);

    // query untuk update setelah user menambahkan data pada transaksi_detail
    function update($data_transaksi_detail) {
        global $conn;
        $query = mysqli_query($conn, "select transaksi.id, sum(transaksi_detail.harga * transaksi_detail.qty) as total from transaksi 
                                inner join transaksi_detail on transaksi.id = transaksi_detail.transaksi_id
                                group by transaksi.id;");
        $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC);
        foreach($hasil as $h) {
            $total = $h['total'];
            $id = $h['id'];
            $stmt = $conn->prepare("UPDATE transaksi SET total = ? WHERE id = ?");
            $stmt->bind_param("ii", $total, $id);
            $stmt->execute();
            $stmt->close();            
        }
    }

    // query untuk penambahan pada data pelanggan
    function tambahPelanggan($id, $nama, $kelamin, $telp, $alamat) {
        global $conn;
        $query = $conn->prepare("INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat)
        VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $id, $nama, $kelamin, $telp, $alamat);
        $query->execute();
        $query->close();
        $conn->close();
    }

    // query penambahan data pada transaksi
    function tambahTransaksi($waktu_transaksi, $keterangan, $total, $pelanggan_id) {
        global $conn;
        session_start();
        $id_user = $_SESSION['id_user'];
        (int)$total;
        if($total == null) {
            $total = 0;
        }
        (int)$pelanggan_id;
        $stmt = $conn->prepare("
            INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssisi", $waktu_transaksi, $keterangan, $total, $pelanggan_id, $id_user);
        $stmt->execute();
        $stmt->close();
    }

    // query untuk melihat transaksi
    function LihatTransaksi($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT pelanggan.nama, transaksi.waktu_transaksi, transaksi.keterangan, transaksi.total, 
                                barang.nama_barang, barang.harga, transaksi_detail.qty 
                                FROM transaksi  
                                INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
                                INNER JOIN transaksi_detail ON transaksi_detail.transaksi_id = transaksi.id 
                                INNER JOIN barang ON transaksi_detail.barang_id = barang.id 
                                WHERE transaksi.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $hasil;
    }

    // query penambahan data pada detail_transaksi
    function tambahDetailTransaksi($barang, $transaksi, $qty) {
        global $conn, $data_transaksi_detail;
        (int)$barang;
        (int)$transaksi;
        (int)$qty;

        // ambil stok
        $stmt = $conn->prepare("SELECT stok FROM barang WHERE id = ?");
        $stmt->bind_param("i", $barang);
        $stmt->execute();
        $stok = $stmt->get_result()->fetch_assoc()['stok'];
        $stmt->close();

        $hasil = $stok - $qty;

        // update stok
        $stmt = $conn->prepare("UPDATE barang SET stok = ? WHERE id = ?");
        $stmt->bind_param("ii", $hasil, $barang);
        $stmt->execute();
        $stmt->close();

        // ambil harga
        $stmt = $conn->prepare("SELECT harga FROM barang WHERE id = ?");
        $stmt->bind_param("i", $barang);
        $stmt->execute();
        $harga = $stmt->get_result()->fetch_assoc()['harga'];
        $stmt->close();

        // insert detail transaksi
        $stmt = $conn->prepare("
            INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("iiii", $transaksi, $barang, $harga, $qty);
        $stmt->execute();
        $stmt->close();
    }
    
    // menampilkan data saat edit pada pelanggan
    function EditPelanggan($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $hasil;  
    }

    // menampilkan data saat edit pada barang
    function EditBarang($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $hasil;
    }

    // menampilkan data saat edit pada user
    function EditUser($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $hasil;
    }

    // menampilkan data saat edit pada supplier
    function EditSupplier($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM supplier WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $hasil;
    }

    // validasi login
    function validateLogin($username, $password, &$msg) {
        global $conn;
        $query = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
        $query->bind_param("ss", $username, md5($password));
        $query->execute();
        $result = $query->get_result();
        $hasil = $result->fetch_assoc();
        $query->close();
        $conn->close();

        session_start();
        if(empty($username)) {
            $msg['login'] = "Tidak boleh kosong";
        } elseif($hasil) {
            $msg['login'] = "";
            $_SESSION['id_user'] = $hasil['id_user'];    
            header('location: admin.php');
        } else {
            $msg['login'] = "Username atau password tidak cocok";
        }
    }

    // fungsi untuk validasi nama
    function validateName($nama, &$msg) {
        if(empty($nama)) {
            $msg['nama'] = "Tidak boleh kosong";
        } elseif(preg_match("/^[a-z]+$/i", $nama)) {
            $msg['nama'] = "";
        } else {
            $msg['nama'] = "nama tidak valid";
        }
    }

    // fungsi untuk validasi tanggal
    function validateDate($tanggal, &$msg) {
        if (empty($tanggal)) {
            $msg['waktu_transaksi'] = "Tidak boleh kosong";
        } elseif ($tanggal < date('Y-m-d')) {
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
    function validateQty($qty, $id_barang, &$msg) {
        global $conn;
        if (empty($qty)) {
            $msg['qty'] = "Tidak boleh kosong";            
        } elseif (preg_match("/^[0-9]+$/", $qty)) {
            $msg['qty'] = "";
            $query = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id_barang");
            $hasil = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];
            if($qty <= $hasil['stok']) {
                $msg['qty'] = "";            
            } else {
                $msg['qty'] = "Stok barang tersisa ".$hasil['stok'];            
            }
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