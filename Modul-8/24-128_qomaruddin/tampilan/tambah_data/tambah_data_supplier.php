<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Form-Login</title>
</head>
<body style="background-color: #D7EBF0;">
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <div class="mt-4 bg-white shadow rounded-3" >

            <div class="p-4 d-flex justify-content-center text-primary">
                <h1>Tambah Supplier Baru </h1>
            </div>
            <form method="POST" class="row g-3 mx-3 mb-3">
                <!-- satu baris -->
                <div class="col-md-3 d-flex justify-content-end">
                    <label for="inputEmail4" class="form-label">Nama Supplier</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control w-75" name="nama" placeholder="Masukkan Nama Supplier">
                </div>
                
                <!-- satu baris -->
                <div class="col-md-3 d-flex justify-content-end">
                    <label for="username" class="form-label">Telp</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control w-75" name="nomor" placeholder="masukkan Telepon">
                </div>
                
                <!-- satu baris -->
                <div class="col-md-3 d-flex justify-content-end">
                    <label for="alamat" class="form-label">ALamat</label>
                </div>
                <div class="col-md-9 ">
                    <textarea name="alamat" id="alamat" class="form-control w-75"></textarea>
                </div>

                <!-- satu baris -->
                <div class="col-5 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                    <a href="../admin/data_master.php" class="btn btn-danger px-3 mx-2">Batal</a>
                </div>
                <?php require_once __DIR__. "../../../data_base/tambah_data/tambah_data_supplier.php"?>
            </form>
        </div>
    </div>
</body>
</html>