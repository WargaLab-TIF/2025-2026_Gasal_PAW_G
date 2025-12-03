    <?php
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_NAME = 'tpp_modul6';

    $koneksi = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    date_default_timezone_set('Asia/Jakarta');
    ?>